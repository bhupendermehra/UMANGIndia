# UmangIndia Project Status — July 31, 2026

## GOAL
Re-apply to Google AdSense after fixing "Low value content" rejection.
**Target reapply date:** ~2-3 weeks from Jul 29, 2026 (≈ mid-Aug 2026).

## COMPLETED (verified live on Hostinger)

### SEO & Technical Fixes
- **Hreflang errors**: Was 197-198 (broken `hreflang="hi"`). Now 0. Canonical tags site-wide.
- **Security headers**: 5/5 live — X-Frame-Options, X-Content-Type-Options, Referrer-Policy, X-XSS-Protection, HSTS. Verified `curl -I` (Jul 31 re-check: still 5/5).
- **Meta titles**: 109/109 schemes ≤60 chars (live DB).
- **Image CLS**: width/height on articles + states banners.
- **Scheme H2 duplicates**: Fixed via preg_replace stripping content-body H2s that duplicate tabs. Verified 0 dupes live.
- **500-error regression** (28 pages): Fixed `$m[1]` bug. All pages 200 OK (Jul 31 re-check: 9 core URLs all 200).
- **Article content — ALL 37 DONE**: Jul 29 batch1+batch2 (excerpts+FAQs) + batch3 (content bodies for IDs 15-24). Jul 31 verified social-welfare-schemes-2026 has real 3-sentence intro, 2 FAQ sections, FAQPage schema. Raw SQL output showed all 37 rows with content_len ≥ 452 and has_faqs=1.

## TRADING BOT (checked Jul 31)
- **Dashboard fix**: `render_dataframe` ImportError — added alias in `dashboard/components/tables.py` (same pattern as earlier `status_badge`/`empty_state` re-exports in `cards.py`). All pages verified via browser: overview, portfolio, risk, scanner, system, trades — no error alerts.
- **Uptime summary added** to daily Telegram report: `_uptime_summary()` in `trading_bot/notify.py`. Includes live-since date, total days, active days, down days, uptime %, target (14 clean days).
- **Stats (Jul 21-31)**: Live since Jul 21. Total 11 days. Active 8. Down/broken 3 (Jul 22 no log, Jul 25 startup crash 11s, Jul 31 partial/ongoing). Uptime 73%.
- **Tests**: Full suite 255 passed (118s). Includes test_notify + test_dashboard_imports.
- **Streamlit**: Restarted clean on port 8501 (`venv/Scripts/python -m streamlit run streamlit_app.py --server.port 8501 --server.headless true`). MUST use venv python, not system python (system python = stale imports).
- **Cycle runner**: PIDs 10828/15344 active. Kill switch + circuit breaker visible in today's log.
- **Known quirk**: TWO streamlit instances were running (venv + system python) — killed system one. Don't start duplicates; port 8501.

## KNOWN PENDING / BROKEN

### ⚠️ SEO Agent keeps DYING on Hostinger
- Runner restarted multiple times (Jul 29, Jul 31). Dies when SSH session closes — Hostinger kills detached processes even with setsid/nohup/disown.
- **Next step needed**: find a persistent solution — Hostinger cron job alternative (hPanel cron? `crontab` binary NOT installed on this shared hosting), or a Windows-side Task Scheduler / startup-folder script that SSHes in periodically to check+restart.

### UmangIndia remaining
- ~12 schemes still have 1-2 fields between 100-150 chars (low priority, not yet expanded).
- getMetaTitle() bug — some schemes show auto-generated title instead of custom meta_title. Not yet investigated.
- Full Screaming Frog crawl NOT re-run since all fixes. Needed before AdSense reapply.

### Trading bot
- Jul 25 crash cause not investigated (11s log = startup crash). Worth checking what failed that day.
- Daily report automation: scheduler sends at 15:30 IST Mon-Fri — uptime block now included.

## RULES FOR NEXT SESSION
1. Do NOT mark anything done based on build/HTTP 200 alone — verify actual content/data live.
2. Provide raw query output when asked, not summarized counts.
3. Continue from PENDING list. Don't restart audits.
4. For streamlit: always `venv/Scripts/python`, single instance, port 8501.
5. SEO agent: verify it's alive FIRST (SSH may need 2-3 retries), restart with `setsid nohup ./runner.sh` if dead.
6. Before AdSense reapply: full Screaming Frog crawl + getMetaTitle fix + remaining thin schemes.

## KEY CONNECTIONS
- **SSH**: `ssh -p 65002 u710844744@46.28.45.195` (password: Youdo@#123) — flaky, retry 2-3x
- **Live MySQL**: `mysql -u u710844744_Bhupe_umang -p'Bhupender@#5243' u710844744_umang_sata`
- **Live domain**: https://umangindia.com
- **SEO agent**: `~/seo-agent/runner.sh` on Hostinger (dies on SSH disconnect — needs cron alternative)
- **UmangIndia project**: `C:\Users\Anudip\Documents\umangindia`
- **Trading bot**: `C:\Users\Anudip\Documents\my-trading-bot` (venv at `venv\Scripts\python.exe`)
- **Local DB**: SQLite `database/database.sqlite`

---

## UIMANGINDIA UI OVERHAUL ROADMAP (agreed Jul 31)

> Goal: make umangindia.com look premium + modern while PRESERVING what works.
> Rule (from Bhupender): improve incrementally, never redesign existing pages
> without asking. Don't touch AdSense/Analytics/integrations. Test locally first,
> deploy to Hostinger only after everything passes.

### Phase A — Audit & baseline (before touching anything)
- [ ] Screenshot + review current home, article show, category, state, admin pages
- [ ] List what's working (keep), what's broken (fix), what's dated (improve)
- [ ] Verify current SEO meta, AdSense code, Analytics tags are all intact

### Phase B — Article pages (highest priority, currently "very poor")
- [ ] Redesign article show: proper hero (category chip, title, date, reading time),
      TOC for long articles, better prose typography, related-article cards,
      sticky share bar, FAQ accordion polish, author box, prev/next nav
- [ ] Article index: card grid with category filters instead of plain list
- [ ] Keep ALL existing JSON-LD (Article/FAQ/Breadcrumb) and SEO meta intact

### Phase C — Global UI polish
- [ ] Layout: sticky header, better nav (mega-menu or clean dropdown), footer upgrade
- [ ] Home: modern hero, category cards, featured schemes carousel, trust signals
- [ ] Category/State pages: card grid + filters + breadcrumbs
- [ ] Search, compare, eligibility, calendar pages: consistent card styling
- [ ] Consistent primary color (existing #0B4EA2 blue) + premium spacing/typography

### Phase D — Admin panel improvement
- [ ] Dashboard: better stat cards, quick actions, recent activity feed
- [ ] Tables: search/filter/sort, bulk actions, status badges
- [ ] Forms: validation UX, autosave, preview buttons
- [ ] Keep admin auth + role checks intact

### Phase E — Test locally, then deploy
- [ ] Full local test: every route 200, no broken JS/CSS, SEO meta intact
- [ ] Verify AdSense + Analytics still present on live after deploy
- [ ] Deploy to Hostinger (git or rsync), verify 3+ live URLs read actual content
- [ ] Post-deploy: Screaming Frog crawl before AdSense reapply

### Never break
- AdSense code, Analytics, existing main links, SEO meta/JSON-LD, admin auth.
- Never redesign a page without asking — incremental improvement only.

### Tools
- Codex/OpenCode for heavy multi-file edits (verify via git diff after),
  terminal for local serve + tests, browser for visual verification.

---

## SESSION — Jul 31 night (UmangIndia overhaul started)

### Done
- **Audit (Phase A complete):** 259 schemes / 16 articles / 12 cats / 37 states. All routes 200. AdSense + GA + JSON-LD intact. **Found: 235 schemes thin content (<800 chars), 174 <150 chars — THE AdSense blocker.** 153 missing official links.
- **Progress tracker:** http://127.0.0.1:8000/progress/ (visual HTML + JSON state, auto-updates).
- **Article pages redesigned (Phase C):** index = hero, Latest/Featured filter, reading-time cards, premium empty state; show = TOC auto-build, prev/next nav, related cards with excerpts, rounded share pills, FAQ chevron polish. Fixed meta_description @section mismatch bug. All @@ JSON-LD preserved.
- **Content expansion started (Phase B):** 36 high-traffic schemes expanded (ids 7-45: PM Kisan cluster, JSY, Stand-Up India, PMRY, APY, NPS, PMGKAY, PMUY, SSY, BBBP, PMMVY, Digital India, SBM, PM-KUSUM, PMVVY, scholarships, Agniveer, SSC/UPSC). 235 → 199 thin. Apply pipeline: scripts/dump_thin_schemes.php + apply_expanded_content.php + public/progress/expanded/batch_*.json.
- **Home/scheme pages:** already strong — no redesign (per UI rule). Scheme show has tabs + sidebar; verified new content renders.

### Delegation blocker
- Subagents (content expansion) FAILED — provider fallback hit Gemini HTTP 429 quota (3 retries). Content written directly by main agent instead. Retry subagents tomorrow if quota resets, or continue manually.

### Next session (priority order)
1. Continue Phase B: expand remaining 199 thin schemes (use same batch pipeline; batches are id-ranges from thin_schemes.json).
2. Phase D: compare/eligibility/calendar/downloads pages consistency check + polish.
3. Phase E: admin panel improvements.
4. Phase F: broken/empty page cleanup + external link check (153 missing official links).
5. Phase G: full local test → deploy Hostinger.

### AdSense timeline (answer for Bhupender)
- Apply ~Aug 25-31 (3-4 weeks): after remaining ~199 schemes expanded, full Screaming Frog crawl, privacy/contact verified. Realistic approval window: 2-8 weeks after application.
