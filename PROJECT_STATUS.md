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
