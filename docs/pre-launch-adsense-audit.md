# Pre-Launch AdSense & Copyright Audit Report

**Audit Date:** July 13, 2026  
**Project:** UmangIndia (Government Schemes Portal)  
**Stack:** Laravel 12 + Blade + Tailwind CSS (CDN) + SQLite  
**Auditor:** opencode (16 parallel expert agents)

---

## Executive Summary

**Verdict: DO NOT LAUNCH TODAY.** The site has multiple critical issues that will almost certainly cause AdSense rejection and could create legal exposure. The most serious problems are:

1. **Schema.org structured data falsely claims the site is a `GovernmentService` provided by `Government of India`** — this is the single highest-risk item
2. **Fabricated trust statistics** ("Trusted by Millions", fake user counts, fake ratings) — deceptive content
3. **`UMANG India` branding closely mimics the official UMANG government app** — trademark risk
4. **APP_DEBUG=true and APP_ENV=local** — security holes if deployed as-is
5. **156 schemes have identical placeholder application process text** — thin/duplicate content
6. **No HTTPS configured** — AdSense requires HTTPS
7. **Broken hreflang tags, missing canonical tags, incomplete sitemap** — SEO issues

Most of these are fixable in 1-2 days of focused work. The site infrastructure is solid; the issues are in content, configuration, and branding choices.

---

## Part 1: Copyright Audit

### 1.1 Copied Text Issues

| # | Severity | File | Issue |
|---|----------|------|-------|
| 1 | **MUST-FIX** | `schemes/show.blade.php:9-23` | Schema.org structured data claims `@type: GovernmentService` with `provider: Government of India`. This is factually false and could be flagged as structured data spam by Google. |
| 2 | **MUST-FIX** | `home.blade.php:214-221` | Fabricated trust statistics: "Trusted by Millions", "10L+ Users Helped", "4.8★ User Rating", "200+ Schemes Listed", "37 States Covered". These are fake numbers presented as fact. |
| 3 | **SHOULD-FIX** | `ExpandedSchemeSeeder2.php:25-28` | 156 schemes share identical placeholder application process: `"Visit official website or nearest government office for application details."` — thin content. |
| 4 | **SHOULD-FIX** | `home.blade.php:267` | "Your trusted portal for complete information" — echoes official government portal language. |
| 5 | **LOW-RISK** | `about.blade.php:23` | "Our mission is to help every citizen understand and access welfare schemes they are entitled to" — reads like a government mandate. |
| 6 | **LOW-RISK** | `pdfs/index.blade.php:4,33` | Repeated use of "official" in user-facing text ("Download official scheme notifications") implies UmangIndia is the source. |

**No verbatim copy-paste from external websites was found in scheme/article content.** All content appears to be originally written, though some uses language that echoes government portal style.

### 1.2 Image Issues

| # | Severity | File | Issue |
|---|----------|------|-------|
| 1 | **MUST-FIX** | `public/images/logo_umang.png` (4.6MB) | **Likely a copy of the official UMANG app logo.** Not referenced in any template but exists in public directory. If it is the official UMANG logo, this is trademark infringement. |
| 2 | **MUST-FIX** | `public/images/icon2.png` (3.8MB) | Unused, suspiciously large. Could contain official government imagery. Needs manual inspection. |
| 3 | **SHOULD-FIX** | `public/images/logo3.png` (596KB) | Unused, not referenced in code. Should be removed or verified. |
| 4 | **VERIFY** | `public/images/logo.png` (5.3KB) | Primary logo used in header and OG tags. Must be visually verified — cannot confirm via code alone that it doesn't contain Ashoka Chakra or national emblem. |
| 5 | **VERIFY** | `public/images/icon.png` (5.3KB) | Favicon. Same verification needed. |

**No external image scraping detected in code.** The `ImageFetcher.php` service exists but references government portal URLs for reference only.

### 1.3 Fonts, Icons & Third-Party Assets

| # | Severity | Asset | License Status |
|---|----------|-------|----------------|
| 1 | **OK** | Google Fonts (Inter, Noto Sans Devanagari) | Apache 2.0 — free for commercial use |
| 2 | **OK** | Tailwind CSS (CDN) | MIT — free for commercial use |
| 3 | **OK** | Heroicons (SVG icons inline) | MIT — free for commercial use |
| 4 | **OK** | Laravel framework | MIT — free for commercial use |
| 5 | **OK** | Google Analytics / AdSense scripts | Standard usage |
| 6 | **CONCERN** | `cdn.tailwindcss.com` in production | The CDN version of Tailwind is meant for prototyping, not production. Should use a compiled CSS build. Performance and reliability risk. |

**No unusual or unclear licenses found.** All JS/CSS libraries are well-known open source.

### 1.4 Government Branding Issues

| # | Severity | File | Issue |
|---|----------|------|-------|
| 1 | **MUST-FIX** | `schemes/show.blade.php:9-23` | JSON-LD structured data: `'@type' => 'GovernmentService', 'provider' => ['@type' => 'GovernmentOrganization', 'name' => 'Government of India']`. This tells Google the site IS a government service. |
| 2 | **MUST-FIX** | `layouts/app.blade.php:144-145` | Header: `UMANG` + `India` with tagline "Government Schemes Portal" — closely mimics official UMANG app (umang.gov.in). No qualifier like "Information Portal" or "Non-official". |
| 3 | **SHOULD-FIX** | `layouts/app.blade.php:134` + footer | Indian tricolor stripe (saffron #FF9933, white, green #138A1A) on every page. Exact national flag colors. Flag Code of India, 2002 restricts commercial use. |
| 4 | **SHOULD-FIX** | `layouts/app.blade.php:312-313` | Footer disclaimer is weak: "This is an informational portal. For official information, visit india.gov.in" — doesn't explicitly say "not affiliated with government". |
| 5 | **LOW-RISK** | `README.md:1` | "UmangIndia Government Schemes Portal" — reads as official title. |
| 6 | **LOW-RISK** | `README.md:329` | Tagline: "Bridging Information Gap Between Government Schemes and Indian Citizens" — implies official mandate. |
| 7 | **LOW-RISK** | `README.md:277` | Fabricated rating: "Project Rating: 4.8/5.0" — false credibility. |

**Positive findings:**
- No Ashoka Chakra or national emblem detected in code
- No "भारत सरकार" text in user-facing templates
- Terms page (line 25) properly disclaims: "NOT an official government website"
- About page has disclaimer linking to india.gov.in
- Footer includes link to india.gov.in

---

## Part 2: Google AdSense Policy Compliance Audit

### 2.1 Required Pages

| Page | Route | Status | Footer Link | Notes |
|------|-------|--------|-------------|-------|
| Privacy Policy | `/privacy-policy` | EXISTS | YES | Very thin — only 39 lines. Missing DPDP Act 2023 compliance, data controller info, user rights, grievance officer. |
| Terms & Conditions | `/terms-and-conditions` | EXISTS | YES | Comprehensive. Properly disclaims government affiliation. |
| About Us | `/about` | EXISTS | YES | Adequate. Has disclaimer. |
| Contact Us | `/contact` | EXISTS | YES | Has email (contact@umangindia.com) and website. No phone/address. |
| Disclaimer | `/disclaimer` | EXISTS | YES | Adequate. Links to india.gov.in. |

**All 4 required pages exist, are linked in footer, and load without errors.** However, the Privacy Policy needs strengthening for Indian law compliance.

### 2.2 Content Originality & Duplication

| # | Severity | Issue |
|---|----------|-------|
| 1 | **MUST-FIX** | **156 schemes in `ExpandedSchemeSeeder2.php` have identical placeholder application process text.** These will appear as thin, near-duplicate content to Google. |
| 2 | **SHOULD-FIX** | State scheme seeders (Maharashtra, UP, Bihar, WB, MP) each have ~20 schemes. While content is original, the descriptions are relatively short and similar in structure. |
| 3 | **SHOULD-FIX** | Article seeders contain ~24 articles total. While content is original, the volume is low for an information portal. |
| 4 | **OK** | Core 24 schemes in `SchemeSeeder.php` have unique, detailed content. |
| 5 | **OK** | Expanded 100+ schemes in `ExpandedSchemeSeeder.php` have unique, detailed content. |

**Content volume assessment:**
- ~340+ schemes total (but 156 have placeholder content)
- ~24 articles total
- 12 categories
- 37 states/UTs
- Homepage, about, contact, privacy, terms, disclaimer, search, compare, eligibility, calendar, downloads pages

**Verdict:** Volume is borderline acceptable, but the 156 duplicate application processes and low article count are concerns.

### 2.3 Navigation & Usability

| # | Severity | Issue |
|---|----------|-------|
| 1 | **OK** | Desktop nav has: Home, All Yojana, Categories dropdown, States dropdown, Latest, Calendar, Downloads, Check Eligibility, Search, Language switcher |
| 2 | **OK** | Mobile nav mirrors desktop with search |
| 3 | **OK** | Footer has 4 columns: About, Quick Links, Categories, Legal |
| 4 | **SHOULD-FIX** | No custom 404 error page (`resources/views/errors/404.blade.php` missing). Laravel will show generic error page. |
| 5 | **SHOULD-FIX** | `welcome.blade.php` still exists — default Laravel page served if route is overridden. |
| 6 | **SHOULD-FIX** | `compare/result.blade.php` has `@if(false)` dead code blocks. |
| 7 | **LOW-RISK** | Nested `<form>` in `compare/result.blade.php` — invalid HTML. |

### 2.4 Prohibited Content Check

| Category | Status |
|----------|--------|
| Adult content | NOT FOUND |
| Gambling | NOT FOUND |
| Weapons | NOT FOUND |
| Illegal drugs | NOT FOUND |
| Hate speech | NOT FOUND |
| Excessive violence | NOT FOUND |
| Counterfeit goods | NOT FOUND |

**Clean — no prohibited content found** in any scheme, article, or page content.

### 2.5 Deceptive/Manipulative Content

| # | Severity | File | Issue |
|---|----------|------|-------|
| 1 | **MUST-FIX** | `home.blade.php:214-221` | Fabricated statistics: "Trusted by Millions", "10L+ Users Helped", "4.8★ User Rating" — fake numbers presented as fact. This is deceptive. |
| 2 | **SHOULD-FIX** | `home.blade.php:36` | "500+ schemes" in meta description — actual count is ~340 (with 156 having placeholder content). |
| 3 | **LOW-RISK** | `home.blade.php:58` | "Verified Information" badge — no verification process exists. |
| 4 | **LOW-RISK** | `home.blade.php:62` | "100% Free" — while true, it's promotional language. |

**No fake countdown timers, fake urgency, or misleading deadline claims found.**

### 2.6 Ad-Ready Layout

| Status | Notes |
|--------|-------|
| **GOOD** | AdSense script is conditionally loaded via Settings model |
| **GOOD** | Header banner slot, footer slot, and in-article slot are implemented |
| **GOOD** | Main content area has reasonable width for ad placement |
| **GOOD** | Content templates have good spacing and are not cramped |
| **CONCERN** | `cdn.tailwindcss.com` is used in production — should use compiled CSS for performance |
| **CONCERN** | Footer ad slot is inside the footer grid — may cause layout issues |

### 2.7 Site Functioning

| Route | Status | Notes |
|-------|--------|-------|
| `/` (home) | OK | Loads with categories, featured schemes, latest schemes |
| `/yojana` (schemes index) | OK | Paginated scheme listing |
| `/yojana/{scheme}` (scheme detail) | OK | Full scheme page with schema.org |
| `/category/{category}` | OK | Category page with schemes |
| `/state/{state}` | OK | State page with schemes |
| `/articles` | OK | Article listing |
| `/article/{article}` | OK | Article detail |
| `/search?q=` | OK | Search functionality |
| `/compare` | OK | Scheme comparison tool |
| `/check-eligibility` | OK | Multi-step eligibility checker |
| `/calendar` | OK | Deadline calendar |
| `/downloads` | OK | PDF downloads page |
| `/about` | OK | About page |
| `/contact` | OK | Contact page |
| `/privacy-policy` | OK | Privacy policy |
| `/terms-and-conditions` | OK | Terms page |
| `/disclaimer` | OK | Disclaimer page |
| `/sitemap.xml` | OK | Dynamic sitemap |
| `/robots.txt` | OK | Dynamic robots.txt |
| `/admin/login` | OK | Admin login |

**No 404s or 500 errors detected on main page types** (tested via code review, not live server).

### 2.8 robots.txt & sitemap.xml

| Item | Status | Details |
|------|--------|---------|
| robots.txt | **PARTIAL** | Dynamic version (via `SitemapController`) is correct: blocks `/admin/`, includes `Sitemap:` directive. But static `public/robots.txt` is a bare stub that may override it. |
| sitemap.xml | **INCOMPLETE** | Dynamic sitemap includes: homepage, schemes index, active schemes, categories, states, about, privacy, disclaimer. **MISSING:** `/latest`, `/articles`, individual articles, `/contact`, `/terms-and-conditions`, `/compare`, `/check-eligibility`, `/calendar`, `/downloads`. |
| Static sitemap | **MISSING** | No `public/sitemap.xml` file. |

### 2.9 HTTPS

| Item | Status |
|------|--------|
| APP_URL | **WRONG** — Set to `http://localhost:8000` |
| HTTPS redirect | **NOT CONFIGURED** — No `.htaccess` rules for HTTPS |
| SESSION_SECURE_COOKIE | **NOT SET** — Defaults to null, cookies sent over HTTP |
| og:url | **WRONG** — Will generate `http://` URLs based on APP_URL |

**HTTPS is not configured. This is a hard requirement for AdSense.**

### 2.10 Page Load / Performance

| # | Severity | Issue |
|---|----------|-------|
| 1 | **SHOULD-FIX** | `cdn.tailwindcss.com` loads full Tailwind runtime (~300KB JS) on every page. Should use compiled CSS. |
| 2 | **SHOULD-FIX** | `logo_umang.png` (4.6MB) and `icon2.png` (3.8MB) exist in public/ — if served, massive performance hit. |
| 3 | **LOW-RISK** | Google Fonts loaded via CDN (2 fonts) — adds latency but acceptable. |
| 4 | **OK** | No obviously broken images in templates. |
| 5 | **OK** | No unoptimized huge files referenced in templates. |

---

## Part 3: Content Spot-Check Results

### 3.1 Scheme Pages (Sampled from Seeders)

| File | Issue | Details |
|------|-------|---------|
| `ExpandedSchemeSeeder2.php` | Placeholder text | 156 schemes: `"Visit official website or nearest government office for application details."` |
| `StateSchemesUttarPradeshSeeder.php:33` | Wrong source URL | Bihar URL (`serviceonline.bihar.gov.in`) referenced in UP seeder |
| `StateSchemesMaharashtraSeeder.php:32-34` | Shared URL | All Maharashtra schemes point to same `mahadbt.maharashtra.gov.in` — needs per-scheme verification |
| `BlogArticleSeeder.php:17` | Mixed language | Hindi text in English `content` field |
| `HindiTranslationSeeder.php:23` | Encoding artifact | `ई-गवर्नेंस` has garbled character |

### 3.2 Article Pages

| File | Issue |
|------|-------|
| `articles/show.blade.php` | Renders raw HTML via `{!! $article->content !!}` — XSS risk if content is compromised |
| `BlogArticleSeeder.php` | Hindi content mixed into English fields |
| All article seeders | Content is original, well-structured, no Lorem ipsum or TODO placeholders |

### 3.3 Homepage & Category Pages

| File | Issue |
|------|-------|
| `home.blade.php` | Fabricated statistics section (lines 214-221) |
| `home.blade.php` | "500+ schemes" in meta — actual is ~340 |
| `home.blade.php` | "Helping Indians access government welfare since 2024" — site is new, claim unverifiable |
| `categories/show.blade.php` | Raw HTML rendering via `{!! $category->description !!}` |
| `states/show.blade.php` | Raw HTML rendering via `{!! $state->description !!}` |

### 3.4 Placeholder Text Check

| Status | Details |
|--------|---------|
| **No Lorem ipsum** | Not found anywhere |
| **No TODO** | Not found in user-facing content |
| **No "as per official portal"** | Not found |
| **156 placeholder application processes** | Found in `ExpandedSchemeSeeder2.php` — identical generic text |

### 3.5 Formatting Issues

| # | File | Issue |
|---|------|-------|
| 1 | `compare/result.blade.php` | Nested `<form>` — invalid HTML |
| 2 | `compare/result.blade.php` | `@if(false)` dead code blocks |
| 3 | `layouts/app.blade.php` | `@yield('meta')` rendered after `<main>` instead of in `<head>` |
| 4 | Multiple files | Missing `rel="noopener noreferrer"` on `target="_blank"` links |
| 5 | `layouts/app.blade.php` | Broken hreflang tags — all three point to same URL |
| 6 | All page templates | Missing `<link rel="canonical">` on most pages |

---

## Fixed Automatically

No fixes were applied automatically. All issues require human review due to the nature of the content and branding decisions involved. The following are **safe, unambiguous fixes** that could be applied:

1. **Delete `public/images/logo_umang.png`** — unused, likely infringing
2. **Delete `public/images/icon2.png`** — unused, suspiciously large
3. **Delete `public/images/logo3.png`** — unused
4. **Delete `welcome.blade.php`** — default Laravel page, not needed
5. **Remove static `public/robots.txt`** — may conflict with dynamic version

---

## Needs Human Decision Before Launch

### PRIORITY 1 — Must fix or AdSense will almost certainly reject

| # | Issue | What to do | Risk if ignored |
|---|-------|-----------|-----------------|
| 1 | **Schema.org claims `GovernmentService` by `Government of India`** | Change to `WebSite` + `Organization` with name "UmangIndia" in `schemes/show.blade.php:9-23` | Google classifies site as government property; structured data spam penalty |
| 2 | **Fabricated statistics** ("Trusted by Millions", fake user counts, fake ratings) | Remove entire trust section from `home.blade.php:212-223` or replace with real metrics | Deceptive content — AdSense rejection |
| 3 | **UMANG India branding** mimics official UMANG app | Add prominent "non-official" qualifier; consider renaming tagline to "Government Schemes Information Portal" | Trademark infringement risk; user confusion |
| 4 | **No HTTPS** | Set `APP_URL=https://umangindia.com`, configure SSL, set `SESSION_SECURE_COOKIE=true` | AdSense hard requirement |
| 5 | **APP_DEBUG=true, APP_ENV=local** | Set `APP_DEBUG=false`, `APP_ENV=production` in production `.env` | Security: stack traces, env vars leaked |
| 6 | **156 schemes with identical placeholder content** | Write unique application process for each, or remove the placeholder schemes | Thin/duplicate content — AdSense rejection |
| 7 | **Privacy Policy too thin** | Expand to include DPDP Act 2023 compliance, data controller info, user rights, grievance officer | Legal risk; AdSense policy non-compliance |

### PRIORITY 2 — Should fix soon (within first week)

| # | Issue | What to do |
|---|-------|-----------|
| 8 | Tricolor stripe mimics Indian flag | Remove or use distinctly different colors |
| 9 | Footer disclaimer too weak | Add "Not affiliated with, endorsed by, or connected to any government body" |
| 10 | Missing canonical tags on most pages | Add `<link rel="canonical">` to all page templates |
| 11 | Broken hreflang tags | Remove or implement URL-based locale switching (`/en/`, `/hi/`) |
| 12 | Incomplete sitemap | Add missing routes: articles, latest, contact, terms, compare, eligibility, calendar, downloads |
| 13 | No custom 404 page | Create `resources/views/errors/404.blade.php` |
| 14 | `cdn.tailwindcss.com` in production | Compile CSS via Vite build |
| 15 | State scheme source URLs unverified | Verify all official website URLs in state seeders |
| 16 | Bihar URL in UP seeder | Fix `StateSchemesUttarPradeshSeeder.php:33` |
| 17 | Mixed Hindi/English in article content | Fix `BlogArticleSeeder.php:17` |
| 18 | SQLite not suitable for production | Migrate to MySQL/PostgreSQL |
| 19 | Missing `package-lock.json` | Run `npm install` before deploy |
| 20 | `User.is_admin` in `$fillable` | Privilege escalation risk — remove from fillable |
| 21 | Draft articles publicly visible | Add `->where('status', 'published')` in `ArticleController::show()` |

### PRIORITY 3 — Low risk but should address

| # | Issue | What to do |
|---|-------|-----------|
| 22 | XSS via raw HTML rendering (`{!! !!}`) | Audit all raw output; use `{!! clean() !!}` with HTML purifier |
| 23 | LIKE wildcard injection in search | Escape `%` and `_` in search queries |
| 24 | No rate limiting on newsletter/share endpoints | Add rate limiting middleware |
| 25 | Missing `rel="noopener noreferrer"` on external links | Add to all `target="_blank"` links |
| 26 | Dead code blocks in compare/result | Remove `@if(false)` blocks |
| 27 | `SchemeUpdate` fillable missing fields | Add `source`, `external_id`, `source_url` to fillable |
| 28 | `Category` model missing `description_hi` in fillable | Add to `$fillable` array |
| 29 | README has fabricated rating | Remove or update with real metrics |
| 30 | Unused images in public/ | Delete `logo_umang.png`, `icon2.png`, `logo3.png` |

---

## Content Volume Summary

| Content Type | Count | Quality |
|-------------|-------|---------|
| Central schemes | ~24 | Good — unique, detailed |
| Expanded schemes | ~100 | Good — unique, detailed |
| JSON-loaded schemes | 156 | **POOR — placeholder content** |
| State schemes (5 states) | ~100 | OK — original but needs URL verification |
| **Total schemes** | **~380** | Mixed — 156 have placeholder content |
| Articles | ~24 | Good — original, well-written |
| Categories | 12 | Good |
| States/UTs | 37 | Good |
| Static pages | 6 (home, about, contact, privacy, terms, disclaimer) | Adequate |
| Tool pages | 4 (compare, eligibility, calendar, downloads) | Functional |

---

## Overall Launch Readiness Verdict

**DO NOT SUBMIT TO ADSENSE TODAY.**

The site has a solid technical foundation — clean Laravel code, good URL structure, proper routing, and original content for most schemes and articles. However, there are **7 critical issues** that will almost certainly cause AdSense rejection:

1. Schema.org data falsely claiming government status
2. Fabricated trust statistics
3. Branding that mimics official government app
4. No HTTPS
5. Debug mode enabled
6. 156 schemes with identical placeholder content
7. Insufficient privacy policy

**Estimated time to fix all critical issues:** 1-2 days of focused work.

**Once critical issues are fixed, the site should be AdSense-ready.** The infrastructure is sound, the content is mostly original, the navigation is clean, and there are no prohibited content issues.

**Recommended launch sequence:**
1. Fix all Priority 1 items (day 1)
2. Fix Priority 2 items (day 1-2)
3. Set `APP_ENV=production`, `APP_DEBUG=false`, configure HTTPS
4. Run `php artisan migrate --force` on production database
5. Seed production database with corrected seeders
6. Test all pages load without errors
7. Submit to AdSense
