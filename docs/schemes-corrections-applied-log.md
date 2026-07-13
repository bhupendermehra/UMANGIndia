# Schemes Corrections Applied Log

**Date:** 2026-07-13
**Command:** `php artisan schemes:apply-corrections`
**Source:** `docs/schemes-verification-report.md` (5-parallel-agent verification of 63 seeded schemes)
**Script:** `app/console/commands/ApplySchemeCorrections.php` (re-runnable, idempotent)

---

## GROUP 1: Deleted Schemes (3 total)

| Scheme | State | Reason | Action |
|--------|-------|--------|--------|
| Vidyarthi Mitra (Earn While Learn) | Maharashtra | Not a government scheme (independent portal vidyarthimitra.org) | Deleted |
| UP Rojgar Abhiyan | Uttar Pradesh | COVID-era campaign (June 2020), closed since 2020 | Deleted |
| Maharashtra Krushi Input Subsidy | Maharashtra | No single scheme by this name; multiple distinct subsidies exist via MahaDBT Farmer | Deleted (Group 6) |

**Recommendation:** UP now has 11 schemes (down from 12). Optionally add "Sewayojan UP" (https://sewayojan.up.nic.in/) as UP's current employment portal to restore 12. Not done automatically — requires new seeder entry.

---

## GROUP 2: Critical Amount Corrections (16 field updates)

| # | Scheme | State | Field | Before | After |
|---|--------|-------|-------|--------|-------|
| 1 | Kanya Sumangala Yojana | UP | benefits | Rs. 15,000 total | Rs. 25,000 total (6 installments: 5K birth, 2K vaccination, 3K Class 1, 3K Class 6, 5K Class 9, 7K graduation) |
| 2 | Ladli Behna Yojana | MP | benefits | Rs. 1,250/month | Rs. 1,500/month (increased March 2026) |
| 3 | Ladli Behna Yojana | MP | short_description | "Rs. 1,250" | "Rs. 1,500" |
| 4 | Mukhyamantri Kisan Kalyan Yojana | MP | benefits | Rs. 4,000/year (total Rs. 10K) | Rs. 6,000/year (total Rs. 12K with PM-KISAN) |
| 5 | Mukhyamantri Kisan Kalyan Yojana | MP | short_description | "Rs. 4,000 per year" | "Rs. 6,000 per year" |
| 6 | Bihar Old Age Pension Scheme | Bihar | benefits | Generic "as per rates" | Rs. 1,100/month (Mukhyamantri Vridhjan Pension, up from Rs. 400 in June 2025) |
| 7 | Mukhyamantri Old Age / Widow / Disability Pension | UP | benefits | Generic "as per portal" | Rs. 1,500/month (increased from Rs. 1,000 in Feb 2026 budget) |
| 8 | Swayam Sahayata Bhatta | Bihar | benefits | Rs. 1,000-1,500/month | Rs. 1,000/month only (max 2 years, requires KYP training) |
| 9 | Swayam Sahayata Bhatta | Bihar | short_description | "Rs. 1,000 - Rs. 1,500" | "Rs. 1,000" |
| 10 | Swayam Sahayata Bhatta | Bihar | meta_description | "Rs. 1,000-1,500/month" | "Rs. 1,000/month" |
| 11 | Mukhyamantri Chikitsa Sahayata Yojana | Bihar | eligibility | Generic income criteria | Income limit Rs. 4 lakh (raised from Rs. 2.5L in June 2026); covers Rs. 20K-5L for serious diseases |
| 12 | Mukhyamantri Chikitsa Sahayata Yojana | Bihar | benefits | Generic "free/assisted treatment" | Rs. 20,000 to Rs. 5,00,000 for serious/untreatable diseases |
| 13 | MJPJAY | Maharashtra | benefits | Rs. 1.5L / Rs. 2.5L | Rs. 1.5L base, Rs. 2.5L renal/critical, Rs. 5L with AB-PMJAY integration |
| 14 | MJPJAY | Maharashtra | content | "Rs. 1.5 lakh / Rs. 2.5 lakh" | Updated to reflect Rs. 5L AB-PMJAY integration |
| 15 | Sanjay Gandhi Niradhar Anudan Yojana | Maharashtra | benefits | Generic "as per notified rate" | Rs. 1,500/month (confirmed) |
| 16 | Kanya Sumangala Yojana | UP | benefits (content) | "Rs. 15,000" in content | Updated installment breakdown |

---

## GROUP 3: Missing Benefit Figures Filled (16 field updates)

| # | Scheme | State | Field | Before | After |
|---|--------|-------|-------|--------|-------|
| 1 | Krishak Bandhu | WB | benefits | "as per official portal" | Rs. 10,000/year income support (>=1 acre) + Rs. 2L death/disability benefit |
| 2 | Gatidhara | WB | benefits | "as per official portal" | 30% subsidy on vehicle, max Rs. 1L (Rs. 1.5L women) |
| 3 | Banglar Bari | WB | benefits | "as per official portal" | Rs. 1.20 lakh per family (Rs. 1.30L hilly areas) |
| 4 | Sikshashree | WB | benefits | "as per official portal" | Rs. 800/year for SC/ST Class V-VIII |
| 5 | WB Old Age/Widow Pension | WB | title | "West Bengal Old Age / Widow Pension" | "Jai Bangla Pension Scheme (West Bengal)" |
| 6 | Jai Bangla Pension | WB | benefits | "as per official portal" | Rs. 1,000/month for all categories |
| 7 | Jai Bangla Pension | WB | short_description | "as per official portal" | Unified Jai Bangla, Rs. 1,000/month |
| 8 | Sambal Yojana | MP | benefits | "as per official portal" | Multi-benefit: free 200 units electricity, Rs. 2-4L accident insurance, Rs. 16K maternity, Rs. 5K funeral, free education |
| 9 | Sambal Yojana | MP | short_description | "Electricity bill relief" | Comprehensive social security for unorganised workers |
| 10 | Sambal Yojana | MP | content | Generic electricity scheme | Full multi-benefit content rewrite |
| 11 | Ladli Laxmi Yojana | MP | benefits | "as per official rates" | Rs. 1,43,000 total structured benefit across milestones |
| 12 | MP Old Age/Widow Pension | MP | benefits | "as per department rates" | Rs. 600/month (60-79), Rs. 800/month (80+) |
| 13 | Gaon Ki Beti / Pratibha Kiran | MP | benefits | "as per official rates" | Rs. 5,000/year general, Rs. 7,500/year eng/med |
| 14 | Balika Protsahan Yojana | Bihar | benefits | "as per official rates" | Rs. 10,000 (Matric) / Rs. 25,000 (Intermediate) |
| 15 | Bihar Kanya Vivah Yojana | Bihar | benefits | "as per official rates" | Rs. 5,000 + Rs. 2,000 registered = Rs. 7,000 (flagged: possible increase to Rs. 10K) |
| 16 | Kanya Sumangala Yojana | UP | benefits | "as per official portal" | (see Group 2 above) |

---

## GROUP 4: Source/Portal URL Corrections (14 updates)

| # | Scheme | State | Before | After |
|---|--------|-------|--------|-------|
| 1 | MJPJAY | Maharashtra | mahadbt.maharashtra.gov.in | https://jeevandayee.gov.in/ |
| 2 | Mukhyamantri Gram Sadak Yojana | Maharashtra | mahadbt.maharashtra.gov.in | https://rdd.maharashtra.gov.in/en/scheme/mukhymantri-gramsadak-yojana/ |
| 3 | Shiv Bhojan Thali | Maharashtra | mahadbt.maharashtra.gov.in | https://mahafood.gov.in/en/shivbhojan/ |
| 4 | Majhi Kanya Bhagyashree Yojana | Maharashtra | mahadbt.maharashtra.gov.in | https://womenchild.maharashtra.gov.in/ |
| 5 | Maharashtra MGNREGA | Maharashtra | mahadbt.maharashtra.gov.in | https://mahaegs.in/ |
| 6 | Sanjay Gandhi Niradhar Anudan | Maharashtra | mahadbt.maharashtra.gov.in | https://sjsa.maharashtra.gov.in/ |
| 7 | Mahatma Phule Karj Mafi | Maharashtra | mahadbt.maharashtra.gov.in | https://mjpsky.maharashtra.gov.in/ |
| 8 | Mukhyamantri Abhyudaya Yojana | UP | www.up.gov.in | https://abhyudayup.in/ |
| 9 | UP e-District Services | UP | www.up.gov.in | https://edistrict.up.gov.in/ |
| 10 | MP e-District Services | MP | www.mp.gov.in | https://mpedistrict.gov.in |
| 11 | Ladli Behna Yojana | MP | www.mp.gov.in | https://ladlibehna.mp.gov.in |
| 12 | Ladli Laxmi Yojana | MP | www.mp.gov.in | https://ladlilaxmi.mp.gov.in |
| 13 | MP Old Age/Widow Pension | MP | www.mp.gov.in | https://socialsecurity.mp.gov.in |
| 14 | Sambal Yojana | MP | www.mp.gov.in | https://sambal.mp.gov.in |

---

## GROUP 5: Name Corrections (2 renames)

| # | Old Name | New Name | State | Other Changes |
|---|----------|----------|-------|---------------|
| 1 | UP Free Laptop / Tablet Yojana | Swami Vivekananda Yojana (UP) | UP | Description updated: tablet-only (no laptops), content rewritten for DigiShakti portal |
| 2 | Mukhyamantri Yuva Swarozgar Yojana | Mukhyamantri Yuva Udyami Yojana | MP | Benefits filled: Rs. 10L-2Cr loan, 15-20% margin, 5-6% interest subsidy for 7 years |

---

## GROUP 6: Clarification Items (6 items resolved)

### 6.1 Annapurna Yojana Maharashtra
- **Decision:** Renamed to "Mukhyamantri Annapurna Yojana (Maharashtra)"
- **Rationale:** The Maharashtra state scheme provides 3 free LPG cylinders/year to women with Ujjwala connections. Distinct from central NFSA Annapurna (10kg food grains for seniors 65+). The Maharashtra variant was the intended entry.
- **Official website:** https://mahafood.gov.in/

### 6.2 Mukhyamantri Awas Yojana Maharashtra
- **Decision:** Renamed to "Pradhan Mantri Awas Yojana (Maharashtra)"
- **Rationale:** No standalone state housing scheme exists by this name. This is the central PMAY (G + Urban) implemented in Maharashtra with 60:40 central:state funding.
- **Official website:** https://rdd.maharashtra.gov.in/en/scheme/pradhan-mantri-awas-yojana-rural/

### 6.3 Maharashtra Krushi Input Subsidy
- **Decision:** Deleted
- **Rationale:** No single scheme by this name exists. Maharashtra offers multiple distinct agriculture subsidies (tractor, solar pump, seed, fertilizer) through MahaDBT Farmer portal. "Krushi Input Subsidy" was a generic term, not a specific scheme.

### 6.4 MP Krishak Samriddhi Yojana
- **Decision:** Kept and clarified as MSP incentive scheme
- **Rationale:** Confirmed as a real, separate scheme (Mukhyamantri Krishak Samriddhi Yojana / MMKSY) providing per-quintal MSP incentive payments to farmers selling at government procurement centres. Distinct from Kisan Kalyan Yojana (direct income support).

### 6.5 Mukhyamantri Awas Yojana MP
- **Decision:** Renamed to "Pradhan Mantri Awas Yojana (Madhya Pradesh)"
- **Rationale:** This is the central PMAY implemented in MP. Standalone MP housing schemes (Ladli Behna Awas Yojana, Bhu-Adhikar Yojana) are noted in the description as separate entries.
- **Official website:** https://pmaymis.gov.in/

### 6.6 Sanjivani / Mukhyamantri Health Scheme MP
- **Decision:** Renamed to "Ayushman Bharat Niramaya (Madhya Pradesh)"
- **Rationale:** No single "Sanjivani Yojana" exists at MP state level. The entry refers to MP's implementation of Ayushman Bharat (Rs. 5L) with complementary Deendayal Antyoday Upchar Yojana (Rs. 2.5L). Renamed to the actual scheme name.
- **Official website:** https://ayushmanbharat.mp.gov.in

---

## Final Scheme Count Per State

| State | Before | After | Change |
|-------|--------|-------|--------|
| Maharashtra | 12 | 10 | -3 (deleted Vidyarthi Mitra, Krushi Input Subsidy; no replacement added) |
| Uttar Pradesh | 12 | 11 | -1 (deleted UP Rojgar Abhiyan; optional Sewayojan UP not added) |
| Bihar | 12 | 12 | 0 |
| West Bengal | 14 | 14 | 0 |
| Madhya Pradesh | 13 | 13 | 0 |
| **TOTAL** | **63** | **60** | **-3** |

---

## Items Still Needing Manual Human Review

1. **Bihar Kanya Vivah Yojana amount:** Some 2026 sources suggest increase to Rs. 10,000 (from Rs. 7,000). Currently flagged in the benefits field with a note. Needs manual verification against https://serviceonline.bihar.gov.in before updating.

2. **Sambal Yojana URL:** Set to https://sambal.mp.gov.in — verify this URL resolves. If not, fallback to https://socialsecurity.mp.gov.in (already set as backup in the command).

3. **UP Sewayojan replacement:** UP Rojgar Abhiyan was deleted but not replaced. Consider adding "Sewayojan UP" (https://sewayojan.up.nic.in/) as UP's current employment portal to restore 12 schemes.

4. **Khadya Sathi (WB) entitlement details:** The verification report noted per-card-category entitlements (AAY=21kg, PHH=3kg/person, etc.) but no specific correction was requested — left as-is with the ₹2/kg rate confirmed.

5. **Saat Nishchay Yojana (Bihar):** Identified as an umbrella framework, not a single scheme. Left as-is since the entry is real and serves as a good overview entry.

---

## Re-running the Command

The correction command is **fully idempotent** — safe to run multiple times. Verified: re-running after application produces 0 changes.

```bash
# Check what would change (dry run):
php artisan schemes:apply-corrections --dry-run

# Apply corrections:
php artisan schemes:apply-corrections
```

Each run checks current values before updating, so previously-applied corrections are skipped ("already up to date"). Name changes (Group 5) and clarifications (Group 6) also check the current title before renaming.
