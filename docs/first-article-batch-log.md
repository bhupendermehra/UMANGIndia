# First Article Batch — Seeding Log

**Date:** 2026-07-13
**Status:** All 12 articles seeded as `draft` — pending owner review before publishing

---

## Summary

| Metric | Value |
|--------|-------|
| Articles seeded | 12 |
| Status | All `draft` |
| Languages | EN + Hindi |
| Word count range | 600–1000 words per article |
| Source data | Scheme records from database only |
| Seeder | `FirstArticleBatchSeeder.php` (idempotent via `updateOrCreate` on slug) |

---

## Articles Seeded

### 1. PM Kisan Apply Online: Step-by-Step Guide for Farmers (2026)
- **Slug:** `pm-kisan-apply-online-step-by-step-guide-2026`
- **Category:** Central Government
- **Angle:** How-to guide
- **Excerpt:** Step-by-step guide to apply for PM-KISAN online. Learn registration process, required documents, eligibility, and how to receive Rs. 6,000 per year directly in your bank account.
- **Source URL:** https://pmkisan.gov.in
- **Fact-check:** Rs. 6,000/year in 3 installments of Rs. 2,000 — confirmed via DB scheme data and official records.

### 2. Kanya Sumangala Yojana Eligibility: Who Qualifies in 2026?
- **Slug:** `kanya-sumangala-yojana-eligibility-criteria-2026`
- **Category:** Uttar Pradesh
- **Angle:** Eligibility explainer
- **Excerpt:** Check Kanya Sumangala Yojana eligibility criteria for 2026. UP families with girls can receive up to Rs. 25,000 in installments from birth to graduation.
- **Source URL:** https://kanyasumangla.up.gov.in
- **Fact-check:** Total benefit Rs. 25,000 in 6 installments — confirmed via DB scheme data.

### 3. Ayushman Bharat PMJAY Documents Required: Full Checklist
- **Slug:** `ayushman-bharat-pmjay-documents-required-checklist`
- **Category:** Central Government
- **Angle:** Documents checklist
- **Excerpt:** Documents required for Ayushman Bharat PMJAY: ration card, Aadhaar, and SECC verification. Get your Ayushman card for Rs. 5 lakh health cover.
- **Source URL:** https://mera.pmjay.gov.in
- **Fact-check:** Rs. 5 lakh cover, SECC 2011 based — confirmed via DB scheme data.

### 4. Ladli Behna Yojana MP: How to Apply Online (2026 Guide)
- **Slug:** `ladli-behna-yojana-mp-how-to-apply`
- **Category:** Madhya Pradesh
- **Angle:** How-to guide
- **Excerpt:** Apply for Ladli Behna Yojana MP online. Get Rs. 1,500 per month financial assistance. Check eligibility and application process for married women of Madhya Pradesh.
- **Source URL:** https://ladlibehna.mp.gov.in
- **Fact-check:** Rs. 1,500/month (increased from Rs. 1,250) — confirmed via DB.

### 5. Top Women & Child Welfare Schemes in West Bengal (2026)
- **Slug:** `top-women-child-schemes-west-bengal-2026`
- **Category:** West Bengal
- **Angle:** Roundup
- **Excerpt:** Explore the best women and child welfare schemes in West Bengal including Kanyashree, Rupashree, Sabooj Sathi, and Swasthya Sathi. Check eligibility and benefits.
- **Source URL:** https://wb.gov.in
- **Fact-check:** All 4 schemes verified against DB records.

### 6. Swasthya Sathi vs Ayushman Bharat: Which Is Better for You?
- **Slug:** `swasthya-sathi-vs-ayushman-bharat-comparison`
- **Category:** West Bengal / Central
- **Angle:** Comparison
- **Excerpt:** Swasthya Sathi vs Ayushman Bharat PMJAY: Compare coverage, eligibility, hospital networks, and application process. Find which scheme fits your family.
- **Source URL:** https://swasthya.sathi.gov.in
- **Fact-check:** Both Rs. 5 lakh coverage confirmed. Swasthya Sathi universal (WB), PMJAY SECC-based (national).

### 7. Bihar Student Credit Card: How to Apply for Rs. 4 Lakh Education Loan
- **Slug:** `bihar-student-credit-card-how-to-apply-education-loan`
- **Category:** Bihar
- **Angle:** How-to guide
- **Excerpt:** Apply for Bihar Student Credit Card (BSCC) for Rs. 4 lakh education loan at 4% interest. Eligibility, documents, and step-by-step application process.
- **Source URL:** https://bscc.bihar.gov.in
- **Fact-check:** Rs. 4 lakh limit, 4% interest — confirmed via DB.

### 8. PM Awas Yojana Gramin: Eligibility, Benefits and How to Apply
- **Slug:** `pm-awas-yojana-gramin-eligibility-benefits-apply`
- **Category:** Central Government
- **Angle:** Eligibility explainer
- **Excerpt:** Check PM Awas Yojana Gramin eligibility for 2026. Get up to Rs. 1.20 lakh for rural housing. Learn application process and required documents.
- **Source URL:** https://pmayg.nic.in
- **Fact-check:** Rs. 1.20 lakh (plain), Rs. 1.30 lakh (hilly) — confirmed via DB.

### 9. Top Education Schemes in Maharashtra for Students in 2026
- **Slug:** `top-education-schemes-maharashtra-students-2026`
- **Category:** Maharashtra
- **Angle:** Roundup
- **Excerpt:** Explore Maharashtra education schemes: MahaDBT Post-Matric Scholarship for tuition support and Majhi Kanya Bhagyashree for girl child incentives.
- **Source URL:** https://mahadbt.maharashtra.gov.in
- **Fact-check:** Both schemes verified against DB records.

### 10. MGNREGA: How to Get 100 Days of Guaranteed Employment
- **Slug:** `mgnrega-100-days-guaranteed-employment-guide`
- **Category:** Central Government
- **Angle:** How-to guide
- **Excerpt:** MGNREGA guarantees 100 days of employment per year to rural households. Learn eligibility, application process, wages, and how to apply.
- **Source URL:** https://nrega.nic.in
- **Fact-check:** 100 days, Rs. 200–350/day — confirmed via DB.

### 11. Sukanya Samriddhi vs Kanya Sumangala: Which Girl Child Scheme Is Better?
- **Slug:** `sukanya-samriddhi-vs-kanya-sumangala-comparison`
- **Category:** Central / Uttar Pradesh
- **Angle:** Comparison
- **Excerpt:** Compare Sukanya Samriddhi (8.2% interest, central) vs Kanya Sumangala (Rs. 25,000 installments, UP). Which girl child scheme suits your family?
- **Source URL:** https://www.nsi.gov.in
- **Fact-check:** SSY 8.2% rate, KSY Rs. 25,000 total — confirmed via DB.

### 12. Sambal Yojana MP: Benefits for Unorganised Workers Explained
- **Slug:** `sambal-yojana-mp-unorganised-workers-benefits-2026`
- **Category:** Madhya Pradesh
- **Angle:** Benefits explainer
- **Excerpt:** Sambal Yojana MP provides free electricity, accident insurance and maternity benefits to unorganised workers. Check eligibility and apply online.
- **Source URL:** https://www.mp.gov.in
- **Fact-check:** Free electricity (200 units), accident cover Rs. 2–4 lakh — confirmed via DB.

---

## Fact-Check Summary

| Article | Key Claim | DB Match | Status |
|---------|-----------|----------|--------|
| PM Kisan | Rs. 6,000/year, 3 installments | Yes | Pass |
| Kanya Sumangala | Rs. 25,000 in 6 installments | Yes | Pass |
| Ayushman Bharat | Rs. 5 lakh, SECC-based | Yes | Pass |
| Ladli Behna | Rs. 1,500/month | Yes | Pass |
| WB Women/Child | 4 schemes verified | Yes | Pass |
| Swasthya vs Ayushman | Both Rs. 5 lakh | Yes | Pass |
| Bihar BSCC | Rs. 4 lakh, 4% interest | Yes | Pass |
| PM Awas Gramin | Rs. 1.20 lakh housing | Yes | Pass |
| MH Education | 2 schemes verified | Yes | Pass |
| MGNREGA | 100 days, Rs. 200–350/day | Yes | Pass |
| Sukanya vs Kanya | SSY 8.2%, KSY Rs. 25K | Yes | Pass |
| Sambal Yojana | Free electricity, insurance | Yes | Pass |

---

## Owner Review Checklist

Before publishing, review each article for:

- [ ] Accuracy of scheme names and amounts
- [ ] Correct internal links (`/scheme/{slug}` paths)
- [ ] Hindi translations quality
- [ ] SEO excerpts are compelling
- [ ] No invented claims beyond DB data
- [ ] Images (if needed) — none seeded yet
- [ ] Set `status` from `draft` to `published` when ready

---

## Files

| File | Purpose |
|------|---------|
| `database/seeders/FirstArticleBatchSeeder.php` | Consolidated seeder (12 articles, idempotent) |
| `database/seeders/seo-articles-seed-data.php` | Agent batch 1 — articles 1–3 |
| `database/seeders/articles_seo_batch.php` | Agent batch 2 — articles 4–6 |
| `database/seeders/ArticleData7to9.php` | Agent batch 3 — articles 7–9 |
| `database/seeders/articles-seo-batch-3.php` | Agent batch 4 — articles 10–12 |

---

## Notes

- Seeder uses `Article::updateOrCreate(['slug' => $data['slug']], $data)` — safe to re-run
- All articles set to `status: draft` for owner review
- All `published_at` set to `null` — set on publish
- No `featured_image`, `meta_title`, or `meta_description` columns in Article model
- Hindi content provided for all articles
