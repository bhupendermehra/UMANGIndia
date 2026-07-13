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
