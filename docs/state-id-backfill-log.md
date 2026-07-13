# State ID Backfill — Investigation & Execution Log

**Project:** UmangIndia (Laravel 12) at `C:\Users\Anudip\Documents\umangindia`
**Date:** 2026-07-12
**Command built:** `php artisan states:backfill-schemes [--dry-run]`
**Mode chosen:** Option A (keyword match on state names in scheme text)

---

## 1. Investigation Findings

### 1.1 Root cause (verified independently)
- `app/Models/Scheme.php` declares a **single** `state_id` foreign key with a
  `belongsTo(State::class)` relation (no pivot table). The `schemes` table
  migration (`2026_07_12_000003_create_schemes_table.php`) defines
  `$table->foreignId('state_id')->nullable()->constrained()->nullOnDelete();`.
- `State::schemes()` is `hasMany(Scheme::class)` — a **one-to-many**, single-FK
  design. `StateController::show()` filters with
  `where('state_id', $state->id)`. There is **no many-to-many** relation.
- All seeders hard-code every scheme to the Central Government record
  (`state_id => $central->id`, where `$central` is `State::where('slug','central-government')`):
  - `database/seeders/SchemeSeeder.php` — every entry uses `'state_id' => $central->id`.
  - `database/seeders/ExpandedSchemeSeeder.php` — does not even set `state_id`
    (so the DB column default/earlier value leaves it at central on insert via
    the model).
  - `database/seeders/ExpandedSchemeSeeder2.php` — explicitly `'state_id' => 1`.
- **Confirmed in the live DB:** Central Government `id = 1`; 37 states total
  (36 states/UTs + Central Government); **all 200 schemes have `state_id = 1`.**

### 1.2 The task premise ("titles contain state names") is FALSE for the seeded data
I scanned all 200 schemes across **every** text column:

| Field                | Schemes mentioning a state name |
|----------------------|---------------------------------|
| `title`              | 0                               |
| `title_hi`           | 0                               |
| `short_description`  | 0                               |
| `short_description_hi`| 0                              |
| `content`            | 0                               |
| `content_hi`         | 0                               |
| `eligibility`        | 3                               |
| `benefits`           | 1                               |
| `meta_keywords`      | 0                               |

So **no scheme title or short_description contains a state name**. The only
state references live in `eligibility` (3) / `benefits` (1). A direct check
confirmed `0` of the 200 titles match any of the 36 state names, and `0` match
in `short_description`.

### 1.3 Concrete examples (real rows from the DB)
The 4 schemes that mention a state at all:

| Scheme | Field | Text excerpt | Verdict |
|--------|-------|--------------|---------|
| Swami Vivekananda Merit cum Means Scholarship | eligibility | "• Domicile of **West Bengal**" | **Genuine** → West Bengal (single state) |
| Char Dham Highway Development Project | eligibility | "• **Uttarakhand** state • Pilgrims and local residents" | **Genuine** → Uttarakhand (single state) |
| Beti Bachao Beti Padhao | eligibility | "• Focus on **Haryana, UP, Bihar, Punjab**" | Ambiguous (4 states) → leave central |
| Industrial Corridor Development Programme | benefits | "• **Delhi**-Mumbai Industrial Corridor • Chennai-Bengaluru Corridor …" | Ambiguous (multi-state) → leave central; note "Delhi-Mumbai" would create a **false positive** if `benefits` were scanned |

No scheme anywhere references **Maharashtra, Uttar Pradesh, Bihar, or Madhya
Pradesh** — meaning per-state counts for those (and a live `/state/maharashtra`
listing) can only be 0 with the current seed data. This is a data fact, not a
command defect.

---

## 2. Chosen Option + Why

**Option A chosen** (keyword match on state names in scheme text):

- **(a) The schema is a single `state_id` FK**, not many-to-many. A pivot table
  (Option B) would require a migration and a model change, and the
  `StateController` already does `where('state_id', $state->id)`. Option B is
  disproportionate and would break the existing one-state-per-scheme UI.
- **(b) Titles/descriptions do NOT carry state names** (see §1.2), so a pure
  title scan reassigns 0. The only *clear, single-state* signals are in
  `eligibility`. I therefore scan `title` + `short_description` (**as the spec
  mandates**) **plus `eligibility`** (the field that actually holds the genuine
  signals). `benefits` is deliberately **excluded** because it produced a false
  positive ("Delhi" inside "Delhi-Mumbai Industrial Corridor").
- **Matching strategy:** word-boundary, case-insensitive substring match of
  (i) all 36 full official state/UT names and (ii) unambiguous uppercase
  aliases (`UP→Uttar Pradesh`, `MP→Madhya Pradesh`, `WB→West Bengal`,
  `CG→Chhattisgarh`, `TN→Tamil Nadu`, `TS→Telangana`, `UK→Uttarakhand`,
  `J&K→Jammu and Kashmir`). **Full-name matches are preferred over abbreviations.**
  A scheme is assigned only when **exactly one distinct state** matches; if
  **multiple distinct states** match it is left central as *ambiguous*; if
  **none** match it is left central as *genuinely central*. Nothing is ever
  assigned on a guess.
- The command is **idempotent / re-runnable**: schemes already pointing at a
  non-central state are skipped, so re-running it (or running it after a seed)
  is safe and changes nothing it shouldn't.

---

## 3. The Command Code

`app/Console/Commands/BackfillSchemeStates.php` (auto-discovered by Laravel 12;
verified with `php artisan list | grep backfill`):

```php
<?php

namespace App\Console\Commands;

use App\Models\Scheme;
use App\Models\State;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

/**
 * states:backfill-schemes
 *
 * Option A backfill: assign each scheme to the single state/UT whose name
 * clearly appears in the scheme's text. Schemes whose text mentions no state,
 * or mentions MULTIPLE distinct states, are left attached to the Central
 * Government record (state_id of the is_central state) and classified as
 * "genuinely central" / "ambiguous" respectively. This command is idempotent
 * and re-runnable: schemes already pointing at a non-central state are skipped.
 *
 * NOTE ON SCAN FIELDS (important, see docs/state-id-backfill-log.md):
 * The original task assumed state names appear in scheme TITLES. Investigation
 * proved that is FALSE for the seeded data: 0 of 200 schemes contain a state
 * name in `title` or `short_description`. The only genuine, clearly-identifiable
 * single-state signals live in the `eligibility` field (e.g. "Domicile of West
 * Bengal", "Uttarakhand state"). We therefore scan title + short_description +
 * eligibility. `benefits` is intentionally EXCLUDED: it produced a false positive
 * ("Delhi" inside "Delhi-Mumbai Industrial Corridor"). The strict single-match
 * rule keeps every assignment safe (multi-state text -> left central).
 */
class BackfillSchemeStates extends Command
{
    protected $signature = 'states:backfill-schemes {--dry-run : Only print changes, do not save}';

    protected $description = 'Assign schemes to the state whose name appears in the scheme text (Option A keyword match).';

    /**
     * Unambiguous uppercase aliases -> official state name.
     * Matched as standalone word-boundary tokens; full names are preferred.
     */
    protected array $stateAliases = [
        'UP'  => 'Uttar Pradesh',
        'MP'  => 'Madhya Pradesh',
        'WB'  => 'West Bengal',
        'CG'  => 'Chhattisgarh',
        'TN'  => 'Tamil Nadu',
        'TS'  => 'Telangana',
        'UK'  => 'Uttarakhand',
        'J&K' => 'Jammu and Kashmir',
    ];

    /**
     * Fields scanned, in priority order. title + short_description are the
     * spec-mandated fields; eligibility is added because that is where the
     * seed data places the only genuine state signals.
     */
    protected array $scanFields = ['title', 'short_description', 'eligibility'];

    public function handle(): int
    {
        // Resolve the 36 states/UTs (exclude the Central Government placeholder).
        $states = State::where('is_central', false)->get();
        if ($states->isEmpty()) {
            $this->error('No states found. Did you run the StateSeeder?');
            return self::FAILURE;
        }

        $stateByName = [];
        foreach ($states as $state) {
            $stateByName[mb_strtolower($state->name)] = $state;
        }

        // Pre-compile word-boundary patterns for full state names.
        $namePatterns = [];
        foreach ($stateByName as $lower => $state) {
            $namePatterns[$lower] = '/\b' . preg_quote($state->name, '/') . '\b/ui';
        }

        // Pre-compile patterns for uppercase aliases -> full state name.
        $aliasPatterns = [];
        foreach ($this->stateAliases as $abbr => $fullName) {
            $aliasPatterns[$abbr] = [
                'pattern' => '/\b' . preg_quote($abbr, '/') . '\b/u',
                'full'    => mb_strtolower($fullName),
            ];
        }

        $centralId = State::where('is_central', true)->value('id');

        $changes      = []; // schemes that WOULD / WILL change
        $ambiguous    = []; // multiple distinct states -> left central
        $alreadyState = 0;  // already assigned to a non-central state (skipped)
        $reassigned   = 0;

        foreach (Scheme::cursor() as $scheme) {
            // Idempotent: skip schemes already assigned to a real state.
            if ($centralId !== null && $scheme->state_id !== null && $scheme->state_id != $centralId) {
                $alreadyState++;
                continue;
            }

            $text = '';
            foreach ($this->scanFields as $field) {
                $text .= ' ' . (string) ($scheme->{$field} ?? '');
            }

            $fullMatches = [];
            foreach ($namePatterns as $lower => $pattern) {
                if (preg_match($pattern, $text)) {
                    $fullMatches[] = $lower;
                }
            }

            $abbrMatches = [];
            foreach ($aliasPatterns as $abbr => $info) {
                if (preg_match($info['pattern'], $text)) {
                    $abbrMatches[] = $info['full'];
                }
            }

            $distinctFull = array_unique($fullMatches);
            $distinctAbbr = array_unique($abbrMatches);

            // Decision (prefer a single full-name match; else a single abbr
            // match; multiple distinct states => ambiguous => leave central).
            $chosen = null;
            if (count($distinctFull) === 1) {
                $chosen = $distinctFull[0];
            } elseif (count($distinctFull) === 0 && count($distinctAbbr) === 1) {
                $chosen = $distinctAbbr[0];
            }

            if ($chosen !== null) {
                $newState = $stateByName[$chosen];
                $changes[] = [
                    'title'     => $scheme->title,
                    'old'       => $scheme->state_id,
                    'new'       => $newState->name,
                    'new_id'    => $newState->id,
                    'id'        => $scheme->id,
                    'signal'    => $newState->name,
                ];
                if (! $this->option('dry-run')) {
                    Scheme::where('id', $scheme->id)->update(['state_id' => $newState->id]);
                }
                $reassigned++;
            } elseif (count($distinctFull) > 1 || count($distinctAbbr) > 1) {
                $ambiguous[] = [
                    'title'  => $scheme->title,
                    'states' => implode(', ', array_map(
                        fn ($l) => $stateByName[$l]->name,
                        array_unique(array_merge($distinctFull, $distinctAbbr))
                    )),
                ];
            }
            // else: no state name found -> stays central (genuinely central).
        }

        // --- Output ---
        $this->info('Scan fields: ' . implode(', ', $this->scanFields));
        $this->info('Central Government state_id: ' . ($centralId ?? 'n/a'));

        if ($changes) {
            $rows = array_map(fn ($c) => [
                Str::limit($c['title'], 60),
                $c['old'],
                $c['new'],
                $c['signal'],
            ], $changes);
            $this->table(['Scheme title', 'Old state_id', 'New state', 'Matched signal'], $rows);
        } else {
            $this->info('No schemes would be reassigned.');
        }

        if ($ambiguous) {
            $this->warn('Ambiguous (multiple states matched, left central): ' . count($ambiguous));
            $this->table(['Scheme title', 'Matched states'], array_map(
                fn ($a) => [Str::limit($a['title'], 60), $a['states']],
                $ambiguous
            ));
        }

        $centralRemaining = Scheme::where('state_id', $centralId)->count();

        $this->line('');
        $this->line('=== SUMMARY ===');
        $this->line('Schemes reassigned : ' . $reassigned);
        $this->line('Ambiguous (central): ' . count($ambiguous));
        $this->line('Already a real state (skipped): ' . $alreadyState);
        $this->line('Remaining central  : ' . $centralRemaining);
        $this->line('Total schemes       : ' . Scheme::count());

        if ($this->option('dry-run')) {
            $this->warn('DRY RUN — no changes written to the database.');
        } else {
            $this->info('UPDATED ' . $reassigned . ' schemes.');
        }

        return self::SUCCESS;
    }
}
```

---

## 4. Dry-Run Output

```
Scan fields: title, short_description, eligibility
Central Government state_id: 1
+-----------------------------------------------+--------------+-------------+----------------+
| Scheme title                                  | Old state_id | New state   | Matched signal |
+-----------------------------------------------+--------------+-------------+----------------+
| Swami Vivekananda Merit cum Means Scholarship | 1            | West Bengal | West Bengal    |
| Char Dham Highway Development Project         | 1            | Uttarakhand | Uttarakhand    |
+-----------------------------------------------+--------------+-------------+----------------+
Ambiguous (multiple states matched, left central): 1
+-------------------------+---------------------------------------+
| Scheme title            | Matched states                        |
+-------------------------+---------------------------------------+
| Beti Bachao Beti Padhao | Bihar, Haryana, Punjab, Uttar Pradesh |
+-------------------------+---------------------------------------+

=== SUMMARY ===
Schemes reassigned : 2
Ambiguous (central): 1
Already a real state (skipped): 0
Remaining central  : 200
Total schemes       : 200
DRY RUN — no changes written to the database.
```

---

## 5. Real Execution Results

```
Scan fields: title, short_description, eligibility
Central Government state_id: 1
+-----------------------------------------------+--------------+-------------+----------------+
| Scheme title                                  | Old state_id | New state   | Matched signal |
+-----------------------------------------------+--------------+-------------+----------------+
| Swami Vivekananda Merit cum Means Scholarship | 1            | West Bengal | West Bengal    |
| Char Dham Highway Development Project         | 1            | Uttarakhand | Uttarakhand    |
+-----------------------------------------------+--------------+-------------+----------------+
Ambiguous (multiple states matched, left central): 1
+-------------------------+---------------------------------------+
| Scheme title            | Matched states                        |
+-------------------------+---------------------------------------+
| Beti Bachao Beti Padhao | Bihar, Haryana, Punjab, Uttar Pradesh |
+-------------------------+---------------------------------------+

=== SUMMARY ===
Schemes reassigned : 2
Ambiguous (central): 1
Already a real state (skipped): 0
Remaining central  : 198
Total schemes       : 200
UPDATED 2 schemes.
```

### Exact counts reassigned, per state
| State        | Reassigned count |
|--------------|------------------|
| West Bengal  | 1  (Swami Vivekananda Merit cum Means Scholarship) |
| Uttarakhand  | 1  (Char Dham Highway Development Project) |
| **Total**    | **2** |

### Totals
- **Reassigned:** 2
- **Ambiguous (left central):** 1
- **Genuinely central (no state name found):** 197
- **Remaining central (`state_id = 1`):** 198
- **Already a real state (skipped, idempotency):** 0 on first run; 2 on re-run
- **Total schemes:** 200

Idempotency re-run (real, second execution): `Schemes reassigned : 0`,
`Already a real state (skipped): 2`, `Remaining central : 198`, `UPDATED 0 schemes.`
→ confirms the command is safe to re-run after every seed.

---

## 6. Live Verification (real queries, not guesses)

### 6.1 Per-state counts (real DB queries)
```
Maharashtra: 0
Uttar Pradesh: 0
Bihar: 0
West Bengal: 1
Madhya Pradesh: 0
---
Remaining central (state_id=1): 198
Total reassigned (state_id!=1): 2
States with >=1 scheme: 2
```
(Only West Bengal and Uttarakhand have schemes; the other four requested states
have 0 because **no scheme in the seed data references them** — see §1.3.)

### 6.2 Live HTTP render of `/state/maharashtra` and `/state/west-bengal`
Booted the HTTP kernel (`bootstrap/app.php` → `Http\Kernel`, `Request::create(...)`,
`handle()`, `getContent()`) and rendered both routes.

**`GET /state/maharashtra` → HTTP 200**
- Hero "totalActive" figure: **0**
- Marker present: **"No schemes found for Maharashtra yet."**
- Snippet: `No schemes found for Maharashtra yet.  Check back soon or browse central schemes available across India.`

> This is the **correct, honest** result: the seed data contains no
> Maharashtra-specific scheme, so the page legitimately shows zero state
> schemes. The command did not fabricate an assignment.

**`GET /state/west-bengal` → HTTP 200**
- Hero "totalActive" figure: **1**
- Marker present: **"Swami Vivekananda"** (the reassigned West Bengal scheme is
  listed in the state page).

> Confirms the backfill end-to-end: a scheme whose `state_id` was reassigned to
> West Bengal (id ≠ 1) now appears on that state's live page via
> `StateController@show` → `where('state_id', $state->id)`.

---

## 7. Schemes That Could Not Be Confidently Classified + Recommendation

### 7.1 Ambiguous (multiple states matched → left central, correctly)
| Scheme | Matched states | Why |
|--------|----------------|-----|
| Beti Bachao Beti Padhao | Bihar, Haryana, Punjab, Uttar Pradesh | Central scheme that "focuses on" several states; not a single-state scheme. Left central. |

(Industrial Corridor Development Programme is also effectively central — it
matched only because `benefits` would have flagged "Delhi"; since `benefits` is
excluded from the scan, it is simply classified as genuinely central.)

### 7.2 Genuinely central (no state name found → left central)
**197 schemes** — all remaining central schemes (PM-KISAN, PMAY, Ayushman
Bharat, MGNREGA, PM Mudra, etc.) are nationwide central schemes with no state
reference in their text, so leaving them at `state_id = 1` (Central Government)
is correct.

### 7.3 Recommendations

1. **`php artisan db:seed` RESETS `state_id` to 1.** Both `SchemeSeeder.php`
   (`'state_id' => $central->id`) and `ExpandedSchemeSeeder2.php`
   (`'state_id' => 1`) hard-code central. After **any** reseed you must re-run:
   ```
   php artisan states:backfill-schemes
   ```
   Add this to deploy/setup docs so the backfill is never lost.

2. **Make the seeders backfill-safe (optional but recommended).** Change both
   seeders so they preserve an already-assigned `state_id` instead of forcing 1.
   Example for `ExpandedSchemeSeeder2.php`:
   ```php
   'state_id' => Scheme::where('slug', $s['s'])->value('state_id') ?? 1,
   ```
   and for `SchemeSeeder.php` replace `'state_id' => $central->id,` with
   `'state_id' => $central->id,` **only on insert** (use `updateOrCreate` and
   drop `state_id` from the update payload, or compute it from the backfill
   logic). This stops `db:seed` from clobbering the backfill.

3. **Enrich the seed data for real per-state pages.** The backfill can only
   assign what the text supports. To get a populated `/state/maharashtra` (and
   other states) you must seed actual Maharashtra/Uttar Pradesh/Bihar/Madhya
   Pradesh state schemes whose titles or eligibility text contain the state
   name. Until then those pages will legitimately show 0 state schemes (the
   central schemes still render via the "Central schemes" section of the page).

4. **Re-run the command after adding state schemes.** Because it is idempotent
   and skips already-assigned schemes, you can run it freely whenever new
   schemes are imported — only genuinely new, clearly state-tagged schemes will
   be assigned.
