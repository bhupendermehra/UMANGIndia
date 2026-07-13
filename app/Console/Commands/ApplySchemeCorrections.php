<?php

namespace App\Console\Commands;

use App\Models\Scheme;
use Illuminate\Console\Command;

/**
 * schemes:apply-corrections
 *
 * Applies verified corrections from docs/schemes-verification-report.md.
 * Re-runnable: safe to run multiple times (idempotent).
 *
 * Groups:
 *   1. Remove non-real / discontinued schemes
 *   2. Critical amount corrections
 *   3. Fill in missing benefit figures
 *   4. Source/portal URL corrections
 *   5. Name corrections
 *   6. Clarification items (resolved via research)
 */
class ApplySchemeCorrections extends Command
{
    protected $signature = 'schemes:apply-corrections {--dry-run : Only print changes, do not save}';

    protected $description = 'Apply verified corrections from the schemes verification report (63 state schemes).';

    public function handle(): int
    {
        $dryRun = $this->option('dry-run');
        $totalChanges = 0;

        $this->newLine();
        $this->info('=== SCHEMES CORRECTION COMMAND ===');
        if ($dryRun) {
            $this->warn('DRY RUN MODE — no changes will be written.');
        }
        $this->newLine();

        // ─────────────────────────────────────────────
        // GROUP 1: DELETE non-real / discontinued schemes
        // ─────────────────────────────────────────────
        $this->info('--- GROUP 1: Deleting non-real / discontinued schemes ---');

        $deletes = [
            ['title' => 'Vidyarthi Mitra (Earn While Learn)', 'reason' => 'Not a government scheme (independent portal)'],
            ['title' => 'UP Rojgar Abhiyan', 'reason' => 'COVID-era campaign, closed since 2020'],
        ];

        foreach ($deletes as $del) {
            $scheme = Scheme::where('title', $del['title'])->first();
            if ($scheme) {
                $this->line("  DELETE: \"{$scheme->title}\" (id={$scheme->id}, state_id={$scheme->state_id}) — {$del['reason']}");
                if (!$dryRun) {
                    $scheme->delete();
                }
                $totalChanges++;
            } else {
                $this->warn("  SKIP: \"{$del['title']}\" — not found in database");
            }
        }

        // ─────────────────────────────────────────────
        // GROUP 2: CRITICAL AMOUNT CORRECTIONS
        // ─────────────────────────────────────────────
        $this->newLine();
        $this->info('--- GROUP 2: Critical amount corrections ---');

        $amountUpdates = [
            // Kanya Sumangala Yojana (UP)
            [
                'slug' => 'kanya-sumangala-yojana-up',
                'title' => 'Kanya Sumangala Yojana',
                'field' => 'benefits',
                'old' => 'Rs. 15,000',
                'new' => 'Rs. 25,000 total, paid in 6 installments: Rs. 5,000 (birth) + Rs. 2,000 (vaccination) + Rs. 3,000 (Class 1) + Rs. 3,000 (Class 6) + Rs. 5,000 (Class 9) + Rs. 7,000 (graduation). Income limit: Rs. 3 lakh. Max 2 girls per family.',
            ],
            // Ladli Behna Yojana (MP)
            [
                'slug' => 'ladli-behna-yojana-mp',
                'title' => 'Ladli Behna Yojana (Madhya Pradesh)',
                'field' => 'benefits',
                'old' => 'Rs. 1,250 per month as financial assistance, credited directly to the beneficiary bank account via DBT.',
                'new' => 'Rs. 1,500 per month as financial assistance, credited directly to the beneficiary bank account via DBT. (Increased from Rs. 1,250, effective March 2026.)',
            ],
            // Ladli Behna Yojana (MP) - short_description
            [
                'slug' => 'ladli-behna-yojana-mp',
                'title' => 'Ladli Behna Yojana (Madhya Pradesh)',
                'field' => 'short_description',
                'old' => 'Monthly financial assistance of Rs. 1,250',
                'new' => 'Monthly financial assistance of Rs. 1,500',
            ],
            // Mukhyamantri Kisan Kalyan Yojana (MP)
            [
                'slug' => 'mukhyamantri-kisan-kalyan-yojana-mp',
                'title' => 'Mukhyamantri Kisan Kalyan Yojana (Madhya Pradesh)',
                'field' => 'benefits',
                'old' => 'Rs. 4,000 per year as state top-up',
                'new' => 'Rs. 6,000 per year as state top-up (over and above PM-KISAN Rs. 6,000), totalling Rs. 12,000 per year, transferred via DBT.',
            ],
            // Mukhyamantri Kisan Kalyan Yojana (MP) - short_description
            [
                'slug' => 'mukhyamantri-kisan-kalyan-yojana-mp',
                'title' => 'Mukhyamantri Kisan Kalyan Yojana (Madhya Pradesh)',
                'field' => 'short_description',
                'old' => 'State top-up of Rs. 4,000 per year',
                'new' => 'State top-up of Rs. 6,000 per year',
            ],
            // Bihar Old Age Pension
            [
                'slug' => 'bihar-old-age-pension-bihar',
                'title' => 'Bihar Old Age Pension Scheme',
                'field' => 'benefits',
                'old' => 'Monthly old-age pension as per the Bihar Social Welfare Department rates',
                'new' => 'Rs. 1,100 per month (Mukhyamantri Vridhjan Pension Yojana, increased from Rs. 400 in June 2025). Separate central IGNOAP pension of Rs. 200/month for 60+ BPL also available. Credited via DBT.',
            ],
            // UP Old Age/Widow/Disability Pension
            [
                'slug' => 'mukhyamantri-pension-yojana-up',
                'title' => 'Mukhyamantri Old Age / Widow / Disability Pension',
                'field' => 'benefits',
                'old' => 'As per official portal: monthly pension transferred via DBT',
                'new' => 'Rs. 1,500 per month per beneficiary (increased from Rs. 1,000 in Feb 2026 budget). Covers Old Age (60+), Widow (18+), and Disability (40%+). Income limit: Rs. 3 lakh/year. Disbursed quarterly via DBT.',
            ],
            // Swayam Sahayata Bhatta (Bihar) - correct amount
            [
                'slug' => 'mukhyamantri-nishchay-swayam-sahayata-bhatta-bihar',
                'title' => 'Mukhyamantri Nishchay Swayam Sahayata Bhatta (Bihar)',
                'field' => 'benefits',
                'old' => 'Rs. 1,000 - Rs. 1,500 per month',
                'new' => 'Rs. 1,000 per month (corrected — the Rs. 1,500 upper range is incorrect per official sources). Provided for max 2 years. Requires Kushal Yuva Program (KYP) training enrollment.',
            ],
            // Swayam Sahayata Bhatta (Bihar) - short_description
            [
                'slug' => 'mukhyamantri-nishchay-swayam-sahayata-bhatta-bihar',
                'title' => 'Mukhyamantri Nishchay Swayam Sahayata Bhatta (Bihar)',
                'field' => 'short_description',
                'old' => 'Monthly unemployment allowance of Rs. 1,000 - Rs. 1,500',
                'new' => 'Monthly unemployment allowance of Rs. 1,000',
            ],
            // Swayam Sahayata Bhatta (Bihar) - meta_description
            [
                'slug' => 'mukhyamantri-nishchay-swayam-sahayata-bhatta-bihar',
                'title' => 'Mukhyamantri Nishchay Swayam Sahayata Bhatta (Bihar)',
                'field' => 'meta_description',
                'old' => 'Rs. 1,000-1,500/month',
                'new' => 'Rs. 1,000/month',
            ],
            // Chikitsa Sahayata Yojana (Bihar) - income limit update
            [
                'slug' => 'mukhyamantri-chikitsa-sahayata-bihar',
                'title' => 'Mukhyamantri Chikitsa Sahayata Yojana (Bihar)',
                'field' => 'eligibility',
                'old' => 'Residents of Bihar meeting the eligibility and income criteria',
                'new' => 'Residents of Bihar with annual family income up to Rs. 4 lakh (increased from Rs. 2.5 lakh in June 2026). Covers Rs. 20,000 to Rs. 5,00,000 for serious/untreatable diseases at govt or CGHS-approved hospitals.',
            ],
            // Chikitsa Sahayata Yojana (Bihar) - benefits
            [
                'slug' => 'mukhyamantri-chikitsa-sahayata-bihar',
                'title' => 'Mukhyamantri Chikitsa Sahayata Yojana (Bihar)',
                'field' => 'benefits',
                'old' => 'Free or assisted medical treatment at government hospitals, as per the official scheme norms.',
                'new' => 'Rs. 20,000 to Rs. 5,00,000 for serious/untreatable diseases. Income limit: Rs. 4 lakh/year (raised from Rs. 2.5 lakh in June 2026). Treatment at government or CGHS-approved hospitals.',
            ],
            // MJPJAY (Maharashtra) - update benefits to include AB-PMJAY integration
            [
                'slug' => null, // auto-generated slug
                'title' => 'Mahatma Jyotiba Phule Jan Arogya Yojana',
                'field' => 'benefits',
                'old' => 'Cashless health cover of Rs. 1.5 lakh per family per year (Rs. 2.5 lakh for senior citizens and specified critical illnesses)',
                'new' => 'Cashless health cover: Rs. 1.5 lakh per family per year (base). Rs. 2.5 lakh for renal transplant and specified critical illnesses. Rs. 5 lakh per family per year when integrated with Ayushman Bharat PM-JAY. Covers 1,356 procedures across 34 specialties.',
            ],
            // MJPJAY (Maharashtra) - content update
            [
                'slug' => null,
                'title' => 'Mahatma Jyotiba Phule Jan Arogya Yojana',
                'field' => 'content',
                'old' => 'Cover of Rs. 1.5 lakh per family per year (Rs. 2.5 lakh for senior citizens and specified critical illnesses)',
                'new' => 'Cover of Rs. 1.5 lakh per family per year (base); Rs. 2.5 lakh for senior citizens and critical illnesses; Rs. 5 lakh when integrated with Ayushman Bharat PM-JAY',
            ],
            // Sanjay Gandhi Niradhar Anudan (Maharashtra) - confirm amount
            [
                'slug' => null,
                'title' => 'Sanjay Gandhi Niradhar Anudan Yojana',
                'field' => 'benefits',
                'old' => 'Monthly pension amount as per the official notified rate',
                'new' => 'Rs. 1,500 per month financial assistance, credited directly to the beneficiary bank account. Covers destitute aged 18-65, widows, orphans, disabled, seriously ill (TB, cancer, AIDS, leprosy), abandoned/divorced women, transgender, devadasis, unmarried women over 35. Annual family income up to Rs. 21,000.',
            ],
        ];

        foreach ($amountUpdates as $upd) {
            $scheme = $this->findScheme($upd);
            if (!$scheme) {
                $this->warn("  SKIP: \"{$upd['title']}\" — not found");
                continue;
            }

            $currentValue = $scheme->{$upd['field']} ?? '';
            // Check if old value is a substring of current value (to handle variations)
            $needsUpdate = str_contains($currentValue, $upd['old']);

            if ($needsUpdate) {
                $this->line("  UPDATE [{$upd['field']}]: \"{$upd['title']}\"");
                $this->line("    OLD: " . \Illuminate\Support\Str::limit($currentValue, 120));
                $this->line("    NEW: " . \Illuminate\Support\Str::limit($upd['new'], 120));
                if (!$dryRun) {
                    $scheme->update([$upd['field'] => $upd['new']]);
                }
                $totalChanges++;
            } else {
                $this->line("  OK: \"{$upd['title']}\" [{$upd['field']}] — already up to date or different format");
            }
        }

        // ─────────────────────────────────────────────
        // GROUP 3: FILL IN MISSING BENEFIT FIGURES
        // ─────────────────────────────────────────────
        $this->newLine();
        $this->info('--- GROUP 3: Filling in missing benefit figures ---');

        $fillUpdates = [
            // Krishak Bandhu (WB)
            [
                'slug' => 'krishak-bandhu-wb',
                'field' => 'benefits',
                'oldContains' => 'as per official',
                'new' => 'Rs. 10,000 per year assured income support for farmers with >=1 acre (Rs. 5,000/acre, max Rs. 10,000). Minimum Rs. 4,000/year for <1 acre. Rs. 2,00,000 death benefit and Rs. 2,00,000 permanent disability benefit for registered farmers aged 18-60. Paid in 2 installments (Kharif + Rabi).',
            ],
            // Gatidhara (WB)
            [
                'slug' => 'gatidhara-wb',
                'field' => 'benefits',
                'oldContains' => 'as per official',
                'new' => '30% subsidy on ex-showroom price of commercial vehicle, max Rs. 1 lakh (Rs. 1.5 lakh for women applicants). Project cost max Rs. 10 lakh. 5% margin money required. Loan sanctioned through nationalized/cooperative banks.',
            ],
            // Banglar Bari (WB)
            [
                'slug' => 'banglar-bari-wb',
                'field' => 'benefits',
                'oldContains' => 'as per official',
                'new' => 'Rs. 1.20 lakh per family for house construction (Rs. 1.30 lakh for difficult/hilly areas), released in two installments of Rs. 60,000 each. Additional 90-95 person days of MGNREGA unskilled labour wage. Launched Dec 2024.',
            ],
            // Sikshashree (WB)
            [
                'slug' => 'sikshashree-wb',
                'field' => 'benefits',
                'oldContains' => 'as per official',
                'new' => 'Rs. 800 per year for SC/ST day-scholars studying in Class V to VIII in government/government-aided schools. Annual family income must not exceed Rs. 2.5 lakh.',
            ],
            // WB Old Age/Widow Pension - rename to Jai Bangla
            [
                'slug' => 'wb-old-age-widow-pension-wb',
                'field' => 'title',
                'old' => 'West Bengal Old Age / Widow Pension',
                'new' => 'Jai Bangla Pension Scheme (West Bengal)',
            ],
            // WB Old Age/Widow Pension - benefits
            [
                'slug' => 'wb-old-age-widow-pension-wb',
                'field' => 'benefits',
                'oldContains' => 'Monthly social security pension',
                'new' => 'Rs. 1,000 per month for all categories: Old Age (60+), Widow (18+), and Disability (40%+). Previously Rs. 600-750/month; merged into unified Jai Bangla Pension from April 2020. Family income <=Rs. 1,000/month.',
            ],
            // WB Old Age/Widow Pension - short_description
            [
                'slug' => 'wb-old-age-widow-pension-wb',
                'field' => 'short_description',
                'oldContains' => 'as per',
                'new' => 'Unified social security pension of West Bengal (Jai Bangla) providing Rs. 1,000/month to eligible senior citizens, widows and persons with disabilities.',
            ],
            // Sambal Yojana (MP) - replace generic text with actual details
            [
                'slug' => 'sambal-yojana-mp',
                'field' => 'benefits',
                'oldContains' => 'as per official',
                'new' => 'Multi-benefit package for unorganised workers: (1) Free 200 units electricity per month, (2) Accident death/disability insurance Rs. 2-4 lakh, (3) Maternity assistance Rs. 16,000 (4 installments of Rs. 4,000), (4) Funeral assistance Rs. 5,000, (5) Free education for children.',
            ],
            // Sambal Yojana (MP) - short_description
            [
                'slug' => 'sambal-yojana-mp',
                'field' => 'short_description',
                'old' => 'Electricity bill relief scheme for BPL families',
                'new' => 'Comprehensive social security package for unorganised workers of Madhya Pradesh — free electricity, accident insurance, maternity benefit, funeral assistance and education support.',
            ],
            // Sambal Yojana (MP) - content update
            [
                'slug' => 'sambal-yojana-mp',
                'field' => 'content',
                'oldContains' => 'electricity bills to Below Poverty Line',
                'new' => '<p>Sambal Yojana (Mukhyamantri Jan Kalyan) is a comprehensive social security scheme of the Madhya Pradesh government for unorganised workers, providing multiple benefits under one umbrella.</p>
<h3>Key Benefits</h3>
<ul>
<li>Free 200 units of electricity per month</li>
<li>Accident death/disability insurance: Rs. 2-4 lakh</li>
<li>Maternity assistance: Rs. 16,000 (4 installments of Rs. 4,000)</li>
<li>Funeral assistance: Rs. 5,000</li>
<li>Free education for children of beneficiaries</li>
</ul>
<h3>Objective</h3>
<p>To provide a comprehensive social security net to unorganised and informal-sector workers of Madhya Pradesh.</p>',
            ],
            // Ladli Laxmi Yojana (MP)
            [
                'slug' => 'ladli-laxmi-yojana-mp',
                'field' => 'benefits',
                'oldContains' => 'as per official rates',
                'new' => 'Total structured benefit of Rs. 1,43,000 across milestones: Rs. 6,000/year for 5 years (Rs. 30,000 initial deposits) + Rs. 2,000 at Class VI + Rs. 4,000 at Class IX + Rs. 6,000 at Class XI + Rs. 200/month during XI-XII + Rs. 25,000 higher education incentive + tuition fee coverage + Rs. 1,00,000 maturity at age 21 (conditional on Class XII completion and marriage after legal age).',
            ],
            // MP Old Age/Widow Pension
            [
                'slug' => 'mp-old-age-widow-pension-mp',
                'field' => 'benefits',
                'oldContains' => 'as per the Madhya Pradesh',
                'new' => 'Rs. 600 per month for ages 60-79; Rs. 800 per month for age 80+ (Old Age Pension). Same rates apply for Widow Pension (Kalyani, ages 18-79) and Disability Pension (Divyang, 40%+ disability, ages 6+). Payments quarterly via DBT. Over 80 lakh beneficiaries.',
            ],
            // Gaon Ki Beti / Pratibha Kiran (MP)
            [
                'slug' => 'gaon-ki-beti-pratibha-kiran-yojana-mp',
                'field' => 'benefits',
                'oldContains' => 'as per official',
                'new' => 'Gaon Ki Beti (rural girls): Rs. 500/month for 10 months = Rs. 5,000/year for general courses; Rs. 750/month = Rs. 7,500/year for engineering/medical. Pratibha Kiran (urban BPL girls): same amounts. Eligibility: 60%+ in 12th, enrolled in graduation, family income <=Rs. 2 lakh.',
            ],
            // Balika Protsahan Yojana (Bihar)
            [
                'slug' => 'balika-protsahan-yojana-bihar',
                'field' => 'benefits',
                'oldContains' => 'as per official',
                'new' => 'Two tiers: (1) Matric pass: Rs. 10,000 (1st division) or Rs. 8,000 (2nd division). (2) Intermediate pass: Rs. 25,000. Both under Mukhyamantri Kanya Utthan Yojana. Unmarried Bihar girls who passed from BSEB eligible. DBT to Aadhaar-linked bank account.',
            ],
            // Kanya Vivah Yojana (Bihar) - flag for manual review
            [
                'slug' => 'bihar-kanya-vivah-yojana-bihar',
                'field' => 'benefits',
                'oldContains' => 'as per official',
                'new' => 'Marriage grant of Rs. 5,000 (basic) + Rs. 2,000 if marriage registered (total Rs. 7,000) for BPL daughters. NOTE: Some 2026 sources suggest possible increase to Rs. 10,000 — needs manual verification against official portal before updating.',
            ],
        ];

        foreach ($fillUpdates as $upd) {
            $scheme = Scheme::where('slug', $upd['slug'])->first();
            if (!$scheme) {
                $this->warn("  SKIP: slug '{$upd['slug']}' — not found");
                continue;
            }

            $currentValue = $scheme->{$upd['field']} ?? '';
            $needsUpdate = false;

            if (isset($upd['oldContains'])) {
                $needsUpdate = str_contains($currentValue, $upd['oldContains']);
            } elseif (isset($upd['old'])) {
                $needsUpdate = str_contains($currentValue, $upd['old']);
            }

            if ($needsUpdate) {
                $this->line("  UPDATE [{$upd['field']}]: \"{$scheme->title}\"");
                $this->line("    OLD: " . \Illuminate\Support\Str::limit($currentValue, 100));
                $this->line("    NEW: " . \Illuminate\Support\Str::limit($upd['new'], 100));
                if (!$dryRun) {
                    $scheme->update([$upd['field'] => $upd['new']]);
                }
                $totalChanges++;
            } else {
                $this->line("  OK: \"{$scheme->title}\" [{$upd['field']}] — already updated or different format");
            }
        }

        // ─────────────────────────────────────────────
        // GROUP 4: SOURCE/PORTAL URL CORRECTIONS
        // ─────────────────────────────────────────────
        $this->newLine();
        $this->info('--- GROUP 4: Source/portal URL corrections ---');

        $urlUpdates = [
            // Maharashtra schemes
            ['title' => 'Mahatma Jyotiba Phule Jan Arogya Yojana', 'url' => 'https://jeevandayee.gov.in/'],
            ['title' => 'Mukhyamantri Gram Sadak Yojana', 'url' => 'https://rdd.maharashtra.gov.in/en/scheme/mukhymantri-gramsadak-yojana/'],
            ['title' => 'Shiv Bhojan Thali', 'url' => 'https://mahafood.gov.in/en/shivbhojan/'],
            ['title' => 'Majhi Kanya Bhagyashree Yojana', 'url' => 'https://womenchild.maharashtra.gov.in/'],
            ['title' => 'Maharashtra Employment Guarantee (MGNREGA Maharashtra)', 'url' => 'https://mahaegs.in/'],
            ['title' => 'Sanjay Gandhi Niradhar Anudan Yojana', 'url' => 'https://sjsa.maharashtra.gov.in/'],
            ['title' => 'Mahatma Phule Karj Mafi (Farm Loan Waiver)', 'url' => 'https://mjpsky.maharashtra.gov.in/'],
            // UP schemes
            ['slug' => 'mukhyamantri-abhyudaya-yojana-up', 'url' => 'https://abhyudayup.in/'],
            ['slug' => 'up-e-district-services-up', 'url' => 'https://edistrict.up.gov.in/'],
            // MP schemes
            ['slug' => 'mp-e-district-services-mp', 'url' => 'https://mpedistrict.gov.in'],
            ['slug' => 'ladli-behna-yojana-mp', 'url' => 'https://ladlibehna.mp.gov.in'],
            ['slug' => 'ladli-laxmi-yojana-mp', 'url' => 'https://ladlilaxmi.mp.gov.in'],
            ['slug' => 'mp-old-age-widow-pension-mp', 'url' => 'https://socialsecurity.mp.gov.in'],
            ['slug' => 'sambal-yojana-mp', 'url' => 'https://sambal.mp.gov.in'],
        ];

        foreach ($urlUpdates as $upd) {
            $scheme = isset($upd['slug'])
                ? Scheme::where('slug', $upd['slug'])->first()
                : Scheme::where('title', $upd['title'])->first();

            if (!$scheme) {
                $this->warn("  SKIP: " . ($upd['title'] ?? $upd['slug']) . " — not found");
                continue;
            }

            $currentUrl = $scheme->official_website ?? '';
            if ($currentUrl !== $upd['url']) {
                $this->line("  URL: \"{$scheme->title}\"");
                $this->line("    OLD: {$currentUrl}");
                $this->line("    NEW: {$upd['url']}");
                if (!$dryRun) {
                    $scheme->update(['official_website' => $upd['url']]);
                }
                $totalChanges++;
            } else {
                $this->line("  OK: \"{$scheme->title}\" — URL already correct");
            }
        }

        // ─────────────────────────────────────────────
        // GROUP 5: NAME CORRECTIONS
        // ─────────────────────────────────────────────
        $this->newLine();
        $this->info('--- GROUP 5: Name corrections ---');

        // UP Free Laptop/Tablet -> Swami Vivekananda Yojana
        $laptop = Scheme::where('slug', 'up-free-laptop-tablet-yojana-up')->first();
        if ($laptop && $laptop->title !== 'Swami Vivekananda Yojana (UP)') {
            $this->line("  RENAME: \"{$laptop->title}\" -> \"Swami Vivekananda Yojana (UP)\"");
            if (!$dryRun) {
                $laptop->update([
                    'title' => 'Swami Vivekananda Yojana (UP)',
                    'title_hi' => 'स्वामी विवेकानंद योजना (उत्तर प्रदेश)',
                    'short_description' => 'Uttar Pradesh scheme distributing free tablets (no laptops currently) to meritorious students to promote digital literacy and skill development. Formerly known as "Free Laptop/Tablet Yojana".',
                    'short_description_hi' => 'उत्तर प्रदेश की योजना जिसमें मेधावी छात्रों को डिजिटल साक्षरता व कौशल विकास हेतु निःशुल्क टैबलेट वितरित किए जाते हैं (लैपटॉप वर्तमान में नहीं)।',
                    'content' => '<p>The Swami Vivekananda Yojana (formerly UP Free Laptop/Tablet Yojana) distributes free tablet PCs to meritorious students of Uttar Pradesh to promote digital literacy and skill development.</p>
<h3>Key Highlights</h3>
<ul>
<li>Free tablet PCs distributed to eligible students (no laptops or smartphones in current phase)</li>
<li>Target: 25 lakh tablets approved for distribution</li>
<li>Students do NOT register directly — colleges upload data, students complete eKYC via Meri Pehchaan portal</li>
<li>Eligible: regular students in UG/PG/diploma/ITI/medical/technical courses in UP institutions</li>
</ul>
<h3>How it Works</h3>
<p>Distribution managed via DigiShakti portal by UPDESCO. Ongoing distribution rounds in 2026.</p>',
                    'eligibility' => 'Regular students enrolled in UG/PG/diploma/ITI/medical/technical courses in recognised institutions of Uttar Pradesh, as per the criteria on the DigiShakti portal.',
                    'benefits' => 'Free tablet PC to eligible meritorious students (no laptops distributed in current phase).',
                    'meta_title' => 'Swami Vivekananda Yojana UP - Free Tablet for Students',
                    'meta_description' => 'Swami Vivekananda Yojana (UP) provides free tablets to meritorious students. Check eligibility and apply via DigiShakti portal.',
                ]);
            }
            $totalChanges++;
            $this->line("    UPDATED: title, description, content, eligibility, benefits, meta fields");
        } elseif ($laptop) {
            $this->line("  OK: \"{$laptop->title}\" — already renamed");
        } else {
            $this->warn("  SKIP: UP Free Laptop/Tablet Yojana — not found");
        }

        // MP Yuva Swarozgar -> Yuva Udyami
        $yuva = Scheme::where('slug', 'mukhyamantri-yuva-swarozgar-yojana-mp')->first();
        if ($yuva && $yuva->title !== 'Mukhyamantri Yuva Udyami Yojana (Madhya Pradesh)') {
            $this->line("  RENAME: \"{$yuva->title}\" -> \"Mukhyamantri Yuva Udyami Yojana (Madhya Pradesh)\"");
            if (!$dryRun) {
                $yuva->update([
                    'title' => 'Mukhyamantri Yuva Udyami Yojana (Madhya Pradesh)',
                    'title_hi' => 'मुख्यमंत्री युवा उद्यमी योजना (मध्य प्रदेश)',
                    'short_description' => 'Loan-based youth entrepreneurship scheme of Madhya Pradesh providing loans from Rs. 10 lakh to Rs. 2 crore for industry/service projects with margin money and interest subsidy support.',
                    'short_description_hi' => 'मध्य प्रदेश की युवा उद्यमिता ऋण योजना जो उद्योग/सेवा परियोजनाओं हेतु 10 लाख से 2 करोड़ रुपये तक का ऋण देती है।',
                    'benefits' => 'Loan from Rs. 10 lakh to Rs. 2 crore for industry/service projects. Margin money: 15% of project cost (max Rs. 12 lakh general), 20% (max Rs. 18 lakh BPL). Interest subsidy: 5% per annum (6% for women) for up to 7 years.',
                    'meta_title' => 'Mukhyamantri Yuva Udyami Yojana MP - Youth Enterprise Loan',
                    'meta_description' => 'MP Mukhyamantri Yuva Udyami Yojana provides loans Rs. 10L-2Cr for youth entrepreneurship with interest subsidy. Check eligibility.',
                ]);
            }
            $totalChanges++;
            $this->line("    UPDATED: title, description, benefits, meta fields");
        } elseif ($yuva) {
            $this->line("  OK: \"{$yuva->title}\" — already renamed");
        } else {
            $this->warn("  SKIP: MP Yuva Swarozgar Yojana — not found");
        }

        // ─────────────────────────────────────────────
        // GROUP 6: CLARIFICATION ITEMS (resolved via research)
        // ─────────────────────────────────────────────
        $this->newLine();
        $this->info('--- GROUP 6: Clarification items (research resolved) ---');

        // 6.1 Annapurna Yojana Maharashtra -> update to LPG variant
        $annapurna = Scheme::where('title', 'Annapurna Yojana Maharashtra')->first();
        if ($annapurna) {
            $this->line("  CLARIFY: \"Annapurna Yojana Maharashtra\" -> Maharashtra Mukhyamantri Annapurna (LPG)");
            if (!$dryRun) {
                $annapurna->update([
                    'title' => 'Mukhyamantri Annapurna Yojana (Maharashtra)',
                    'title_hi' => 'मुख्यमंत्री अन्नपूर्णा योजना (महाराष्ट्र)',
                    'short_description' => 'Maharashtra scheme providing 3 free LPG cylinders per year to women with PM Ujjwala or Majhi Ladki Bahin connections. (Note: Not to be confused with the central NFSA Annapurna Scheme for senior citizens.)',
                    'short_description_hi' => 'महाराष्ट्र की योजना जो पीएम उज्ज्वला या माझी लाडकी बहीन कनेक्शन वाली महिलाओं को प्रति वर्ष 3 निःशुल्क एलपीजी सिलेंडर देती है।',
                    'content' => '<p>Mukhyamantri Annapurna Yojana is a Maharashtra state scheme launched in 2024 providing free LPG cylinders to women beneficiaries.</p>
<h3>Key Features</h3>
<ul>
<li>3 free 14.2 kg LPG cylinders per year</li>
<li>For women with PM Ujjwala or Majhi Ladki Bahin connections</li>
<li>Implemented by the Food, Civil Supplies & Consumer Protection Department, Maharashtra</li>
</ul>
<h3>Note</h3>
<p>This is different from the central government Annapurna Scheme (NFSA) which provides 10 kg free food grains to destitute senior citizens aged 65+. The Maharashtra scheme focuses on LPG fuel support for women.</p>',
                    'eligibility' => 'Women of Maharashtra with active PM Ujjwala or Majhi Ladki Bahin LPG connections, meeting the eligibility criteria on the state portal.',
                    'benefits' => '3 free 14.2 kg LPG cylinders per year.',
                    'official_website' => 'https://mahafood.gov.in/',
                    'meta_title' => 'Mukhyamantri Annapurna Yojana Maharashtra - Free LPG Cylinders',
                    'meta_description' => 'Maharashtra Mukhyamantri Annapurna Yojana gives 3 free LPG cylinders/year to eligible women. Check eligibility and apply.',
                ]);
            }
            $totalChanges++;
            $this->line("    UPDATED: renamed, re-categorized content to LPG variant");
        } else {
            $this->warn("  SKIP: Annapurna Yojana Maharashtra — not found");
        }

        // 6.2 Mukhyamantri Awas Yojana Maharashtra -> relabel as PMAY
        $mhAwas = Scheme::where('title', 'Mukhyamantri Awas Yojana Maharashtra')->first();
        if ($mhAwas) {
            $this->line("  CLARIFY: \"Mukhyamantri Awas Yojana Maharashtra\" -> PMAY (Maharashtra implementation)");
            if (!$dryRun) {
                $mhAwas->update([
                    'title' => 'Pradhan Mantri Awas Yojana (Maharashtra)',
                    'title_hi' => 'प्रधानमंत्री आवास योजना (महाराष्ट्र)',
                    'short_description' => 'Maharashtra implementation of Pradhan Mantri Awas Yojana (PMAY-Gramin and PMAY-Urban) providing pucca houses to eligible rural and urban poor families. 60:40 central:state funding.',
                    'short_description_hi' => 'प्रधानमंत्री आवास योजना का महाराष्ट्र कार्यान्वयन जो ग्रामीण व शहरी गरीब परिवारों को पक्का मकान देता है।',
                    'content' => '<p>Pradhan Mantri Awas Yojana (PMAY) is implemented in Maharashtra as a central-state joint housing mission. Maharashtra implements both PMAY-Gramin (rural) and PMAY-Urban components.</p>
<h3>Key Features</h3>
<ul>
<li>PMAY-Gramin: Rs. 1.20 lakh (plain) / Rs. 1.30 lakh (hilly/tribal) central assistance for house construction</li>
<li>PMAY-Urban 2.0: Credit-linked subsidy and beneficiary-led construction support</li>
<li>60:40 central:state funding ratio</li>
<li>Implemented through Maharashtra Rural Development Dept and Urban Development Dept</li>
</ul>
<h3>Note</h3>
<p>This is a central government scheme (PMAY) implemented in Maharashtra, not a standalone state scheme.</p>',
                    'benefits' => 'Central assistance of Rs. 1.20-1.30 lakh for rural house construction (PMAY-G); credit-linked subsidy and housing support for urban families (PMAY-U 2.0, 2024-2029).',
                    'official_website' => 'https://rdd.maharashtra.gov.in/en/scheme/pradhan-mantri-awas-yojana-rural/',
                    'meta_title' => 'Pradhan Mantri Awas Yojana Maharashtra - Housing for Poor',
                    'meta_description' => 'PMAY Maharashtra: pucca houses for rural and urban poor families. Check eligibility, apply online.',
                ]);
            }
            $totalChanges++;
            $this->line("    UPDATED: renamed to PMAY, clarified as central scheme");
        } else {
            $this->warn("  SKIP: Mukhyamantri Awas Yojana Maharashtra — not found");
        }

        // 6.3 Maharashtra Krushi Input Subsidy -> remove (no single scheme exists)
        $krushi = Scheme::where('title', 'Maharashtra Krushi Input Subsidy')->first();
        if ($krushi) {
            $this->line("  DELETE: \"Maharashtra Krushi Input Subsidy\" — no single scheme by this name exists");
            $this->line("    Multiple distinct subsidies exist via MahaDBT Farmer (tractor, solar pump, seed, etc.)");
            if (!$dryRun) {
                $krushi->delete();
            }
            $totalChanges++;
        } else {
            $this->warn("  SKIP: Maharashtra Krushi Input Subsidy — not found");
        }

        // 6.4 MP Krishak Samriddhi Yojana -> keep, clarify as MSP incentive scheme
        $krishak = Scheme::where('slug', 'mp-krishak-samriddhi-yojana-mp')->first();
        if ($krishak && !str_contains($krishak->short_description ?? '', 'MSP incentive')) {
            $this->line("  CLARIFY: \"MP Krishak Samriddhi Yojana\" — confirmed as real, MSP incentive scheme");
            if (!$dryRun) {
                $krishak->update([
                    'short_description' => 'Madhya Pradesh scheme providing per-quintal MSP incentive payments to registered farmers who sell eligible produce (wheat, paddy, etc.) at government procurement centres. Distinct from Kisan Kalyan Yojana (direct income support).',
                    'short_description_hi' => 'मध्य प्रदेश की योजना जो सरकारी खरीद केंद्रों पर पात्र उपज बेचने वाले किसानों को प्रति क्विंटल MSP प्रोत्साहन भुगतान देती है।',
                    'content' => '<p>Mukhyamantri Krishak Samriddhi Yojana (MMKSY) is a Madhya Pradesh state scheme providing incentive payments above the Minimum Support Price (MSP) to registered farmers who sell eligible produce at government procurement centres.</p>
<h3>Key Features</h3>
<ul>
<li>Per-quintal MSP incentive payments to farmers</li>
<li>For wheat, paddy, and other notified crops sold at procurement centres</li>
<li>Distinct from Mukhyamantri Kisan Kalyan Yojana (which provides direct income support of Rs. 6,000/year)</li>
<li>Implemented by Farmer Welfare and Agriculture Development Department, MP</li>
</ul>
<h3>Objective</h3>
<p>To incentivise farmers to sell produce at government procurement centres and ensure they receive remunerative prices above MSP.</p>',
                    'benefits' => 'Per-quintal MSP incentive payments for eligible produce sold at government procurement centres. Amount varies by crop and procurement price.',
                ]);
            }
            $totalChanges++;
            $this->line("    UPDATED: clarified as MSP incentive scheme, not duplicate of Kisan Kalyan");
        } elseif ($krishak) {
            $this->line("  OK: \"MP Krishak Samriddhi Yojana\" — already clarified");
        } else {
            $this->warn("  SKIP: MP Krishak Samriddhi Yojana — not found");
        }

        // 6.5 Mukhyamantri Awas Yojana MP -> relabel as PMAY
        $mpAwas = Scheme::where('slug', 'mukhyamantri-awas-yojana-mp')->first();
        if ($mpAwas && $mpAwas->title !== 'Pradhan Mantri Awas Yojana (Madhya Pradesh)') {
            $this->line("  CLARIFY: \"Mukhyamantri Awas Yojana MP\" -> PMAY (MP implementation)");
            if (!$dryRun) {
                $mpAwas->update([
                    'title' => 'Pradhan Mantri Awas Yojana (Madhya Pradesh)',
                    'title_hi' => 'प्रधानमंत्री आवास योजना (मध्य प्रदेश)',
                    'short_description' => 'Madhya Pradesh implementation of Pradhan Mantri Awas Yojana (PMAY-Gramin and PMAY-Urban) providing pucca houses to eligible poor families. Note: Separate standalone MP schemes include Ladli Behna Awas Yojana (Rs. 2L construction) and Mukhyamantri Awas Bhu-Adhikar Yojana (land plots).',
                    'short_description_hi' => 'प्रधानमंत्री आवास योजना का मध्य प्रदेश कार्यान्वयन। अलग से लाडली बहना आवास योजना (2 लाख निर्माण) व भू-अधिकार योजना (भूमि प्लॉट) भी सक्रिय हैं।',
                    'content' => '<p>Pradhan Mantri Awas Yojana (PMAY) is implemented in Madhya Pradesh as a central-state joint housing mission. MP implements both PMAY-Gramin and PMAY-Urban components.</p>
<h3>Key Features</h3>
<ul>
<li>PMAY-Gramin: Rs. 1.20 lakh (plain) / Rs. 1.30 lakh (hilly/tribal) central assistance</li>
<li>PMAY-Urban 2.0: Credit-linked subsidy for EWS/LIG/MIG families</li>
<li>Additional standalone MP schemes: Ladli Behna Awas Yojana (Rs. 2L), Bhu-Adhikar Yojana (land plots)</li>
</ul>
<h3>Note</h3>
<p>This entry refers to the central PMAY implemented in MP. For standalone MP housing schemes, see Ladli Behna Awas Yojana or Mukhyamantri Awas Bhu-Adhikar Yojana.</p>',
                    'benefits' => 'PMAY-G: Rs. 1.20-1.30 lakh central assistance for house construction. PMAY-U 2.0: Credit-linked interest subsidy up to Rs. 1.80 lakh (2024-2029).',
                    'official_website' => 'https://pmaymis.gov.in/',
                    'meta_title' => 'Pradhan Mantri Awas Yojana MP - Housing for Poor',
                    'meta_description' => 'PMAY Madhya Pradesh: pucca houses for poor families. Check eligibility and apply online.',
                ]);
            }
            $totalChanges++;
            $this->line("    UPDATED: renamed to PMAY, clarified as central scheme with standalone MP variants noted");
        } elseif ($mpAwas) {
            $this->line("  OK: \"{$mpAwas->title}\" — already clarified");
        } else {
            $this->warn("  SKIP: Mukhyamantri Awas Yojana MP — not found");
        }

        // 6.6 Sanjivani / Mukhyamantri Health Scheme MP -> Ayushman Bharat Niramaya
        $sanjivani = Scheme::where('slug', 'sanjivani-mukhyamantri-health-scheme-mp')->first();
        if ($sanjivani && $sanjivani->title !== 'Ayushman Bharat Niramaya (Madhya Pradesh)') {
            $this->line("  CLARIFY: \"Sanjivani / Mukhyamantri Health Scheme MP\" -> Ayushman Bharat Niramaya (MP)");
            if (!$dryRun) {
                $sanjivani->update([
                    'title' => 'Ayushman Bharat Niramaya (Madhya Pradesh)',
                    'title_hi' => 'आयुष्मान भारत निरामय (मध्य प्रदेश)',
                    'short_description' => 'Madhya Pradesh implementation of Ayushman Bharat providing Rs. 5 lakh per family per year cashless health cover to BPL families at empanelled hospitals. Also includes Deendayal Antyoday Upchar Yojana (Rs. 2.5L) as a complementary scheme.',
                    'short_description_hi' => 'आयुष्मान भारत का मध्य प्रदेश कार्यान्वयन जो बीपीएल परिवारों को संबद्ध अस्पतालों में प्रति परिवार प्रति वर्ष 5 लाख रुपये तक निःशुल्क उपचार देता है।',
                    'content' => '<p>Ayushman Bharat Niramaya (Mukhyamantri Niramaya Yojana) is Madhya Pradesh\'s state implementation of the central Ayushman Bharat-Pradhan Mantri Jan Arogya Yojana (AB-PMJAY), providing cashless health cover to eligible BPL families.</p>
<h3>Key Features</h3>
<ul>
<li>Rs. 5 lakh per family per year cashless treatment at empanelled hospitals</li>
<li>1,929 treatment packages across 27 specialties</li>
<li>National portability — treatment at any empanelled hospital in India</li>
<li>Complementary Deendayal Antyoday Upchar Yojana provides additional Rs. 2.5 lakh cover</li>
</ul>
<h3>Objective</h3>
<p>To provide financial protection against catastrophic health expenditure to poor and vulnerable families in Madhya Pradesh.</p>',
                    'eligibility' => 'BPL families of Madhya Pradesh as identified under SECC 2011 data and state inclusion criteria. Check eligibility at beneficiary.nha.gov.in.',
                    'benefits' => 'Rs. 5 lakh per family per year cashless treatment at empanelled hospitals (Ayushman Bharat Niramaya). Additional Rs. 2.5 lakh under Deendayal Antyoday Upchar Yojana.',
                    'official_website' => 'https://ayushmanbharat.mp.gov.in',
                    'meta_title' => 'Ayushman Bharat Niramaya MP - Rs. 5 Lakh Health Cover',
                    'meta_description' => 'MP Ayushman Bharat Niramaya gives Rs. 5L cashless health cover to BPL families. Check eligibility and empanelled hospitals.',
                ]);
            }
            $totalChanges++;
            $this->line("    UPDATED: renamed to Ayushman Bharat Niramaya, clarified with actual benefit details");
        } elseif ($sanjivani) {
            $this->line("  OK: \"{$sanjivani->title}\" — already clarified");
        } else {
            $this->warn("  SKIP: Sanjivani / Mukhyamantri Health Scheme MP — not found");
        }

        // ─────────────────────────────────────────────
        // SUMMARY
        // ─────────────────────────────────────────────
        $this->newLine();
        $this->info('=== SUMMARY ===');

        $stateCounts = [
            'Maharashtra' => Scheme::where('state_id', 15)->count(),
            'Uttar Pradesh' => Scheme::where('state_id', 27)->count(),
            'Bihar' => Scheme::where('state_id', 5)->count(),
            'West Bengal' => Scheme::where('state_id', 29)->count(),
            'Madhya Pradesh' => Scheme::where('state_id', 14)->count(),
        ];

        $totalSchemes = array_sum($stateCounts);

        foreach ($stateCounts as $state => $count) {
            $this->line("  {$state}: {$count} schemes");
        }
        $this->line("  TOTAL state-specific: {$totalSchemes}");

        $this->newLine();
        $this->line("Total changes applied: {$totalChanges}");

        if ($dryRun) {
            $this->warn('DRY RUN — no changes were written to the database.');
        } else {
            $this->info('All corrections applied successfully.');
        }

        return self::SUCCESS;
    }

    /**
     * Find a scheme by slug (preferred) or title (fallback).
     */
    private function findScheme(array $upd): ?Scheme
    {
        if (!empty($upd['slug'])) {
            return Scheme::where('slug', $upd['slug'])->first();
        }

        return Scheme::where('title', $upd['title'])->first();
    }
}
