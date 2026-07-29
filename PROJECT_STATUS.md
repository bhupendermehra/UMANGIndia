# UmangIndia Project Status — July 29, 2026

## GOAL
Re-apply to Google AdSense after fixing "Low value content" rejection.
**Target reapply date:** ~2-3 weeks from Jul 29, 2026.

## COMPLETED (verified live on Hostinger)

### SEO & Technical Fixes
- **Hreflang errors**: Was 197-198 (broken `hreflang="hi"` pointing to non-existent `/language/hi`). Now 0. Canonical tags added site-wide. x-default retained.
- **Security headers**: All 5 added and live — X-Frame-Options: SAMEORIGIN, X-Content-Type-Options: nosniff, Referrer-Policy: strict-origin-when-cross-origin, X-XSS-Protection: 1; mode=block, HSTS with preload. Verified via `curl -I`.
- **Meta titles**: All 109 scheme titles trimmed to ≤60 chars. Confirmed via live DB query: 0 over 60.
- **Image CLS fix**: width/height attributes added to images on articles/index.blade.php (800x450 featured, 400x225 cards) and states/show.blade.php (1200x300 banner). Verified in local source.
- **Scheme page H2 duplicates**: Was 162+ generic H2s ("Eligibility Criteria", "Benefits", etc.) duplicated across all 109 scheme pages. Fixed by stripping content-body H2s that duplicate tab panel headings (preg_replace in schemes/show.blade.php). Verified 0 duplicates via curl + `uniq -d` on live pages.

### Content Depth
- **Scheme content expansion**: Expanded 12 thin-content schemes via SQL (IDs 1,6,12,15,52,98,99,100,104,105,107,108,109). Fields increased from 42-150 chars to 500-700+ chars.
- **Article content**: `pm-kisan-2026-complete-guide` confirmed rewritten with unique content (4637 chars), FAQ accordion (5 Q&As), FAQPage schema. Many others updated via batch SQL.

### Bug Fixes
- **500 Internal Server Error regression** (28 pages): Root cause was `$m[1]` reference in `preg_replace_callback` with no capture groups in patterns. Fixed by using `$m[0]` with capture groups wrapping full H2. All 28 pages verified 200 OK.
- **Article model**: Added `'faqs' => 'array'` cast, deployed model to server.
- **SEO Agent**: H1 mapping fixed in `laravel_connector.py`, cron schedule changed from 5-min to 4x daily, stale issues cleaned. Runner restarted on Hostinger.

## KNOWN PENDING / NOT YET VERIFIED

### ⚠️ Article Content — PARTIALLY DONE
- **IDs 15-24** (social-welfare-schemes-2026, women-welfare-schemes-2026, etc.): Content bodies were NOT replaced in batch1+batch2 — only excerpts and FAQs were added. **Batch3.sql was created and deployed** but has NOT been verified by spot-checking live URLs. Need to check these still have the generic 2-sentence content.
- **Full 37-article audit**: Need raw SQL output with per-row `content_len` and `has_faqs` to confirm ALL articles are genuinely fixed, not just the ones spot-checked.

### Content Depth — Remaining
- **~12 schemes** still have 1-2 fields between 100-150 chars (noted earlier as low priority, not yet expanded).
- **getMetaTitle() bug**: Some scheme pages show auto-generated title instead of custom `meta_title`. Not yet investigated.

### Site-wide Re-verification
- **Screaming Frog crawl**: Needs to be re-run and compared against the last crawl to confirm:
  - H2 duplicate count (was 50 after partial fix, target 0)
  - 500 errors (was 28, target 0)
  - Missing canonicals (target 0)
  - Title length issues (target 0)
  - Missing security headers (target 0)
- **Full URL set** verification: Run a broader check beyond the 28+5 sample URLs used so far.

### Navbar
- Reviewed layout code — no obvious bugs found. Desktop dropdowns use `.nav-group:hover > .nav-dropdown`, mobile menu uses JS toggle. No changes made.

## RULES FOR NEXT SESSION
1. Do NOT mark anything "done" based on `npm run build` success or HTTP 200 alone. Verify actual content/data on live URLs.
2. When asked for data, provide raw query output (all rows), not summarized counts.
3. Continue from the PENDING list above. Do NOT restart the full audit.
4. Verify batch3.sql was correctly applied by checking live URLs for social-welfare-schemes-2026, women-welfare-schemes-2026, agriculture-schemes-farmers-2026, health-insurance-schemes-2026, and top-education-schemes-students before doing anything else.
5. Run full Screaming Frog crawl for final comparison before claiming AdSense readiness.

## SERVICES STATUS (check of Jul 29)
- **Trading bot**: Project files present at `C:\Users\Anudip\Documents\my-trading-bot\`. Mode: PAPER (confirmed in README_AUTOSTART.md). No main.py/bot.py — runs via streamlit_app.py dashboard. SQLite persistence with WAL mode.
- **SEO agent runner**: Was stopped. **Restarted** at end of session — confirmed 2 processes running. Schedules: 03:00, 06:30, 10:30, 14:00 UTC (≈08:30, 11:00, 15:00, 18:30 IST). Logs at `~/seo-agent/logs/`.
- **SSH to Hostinger**: Intermittent — sometimes works, sometimes times out. Retry 2-3 times if first attempt fails.

## KEY CONNECTIONS
- **SSH**: `ssh -p 65002 u710844744@46.28.45.195` (password: Youdo@#123)
- **Live MySQL**: `mysql -u u710844744_Bhupe_umang -p'Bhupender@#5243' u710844744_umang_sata`
- **Live domain**: https://umangindia.com
- **SEO agent**: `~/seo-agent/runner.sh` on Hostinger (starts via nohup)
- **Project root**: `C:\Users\Anudip\Documents\umangindia`
- **Local DB**: SQLite at `database/database.sqlite`
