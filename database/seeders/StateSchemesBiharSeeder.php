<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Scheme;
use App\Models\State;
use Illuminate\Database\Seeder;

class StateSchemesBiharSeeder extends Seeder
{
    public function run(): void
    {
        // Bihar state (slug 'bihar', id = 5)
        $state = State::where('slug', 'bihar')->first();

        if (! $state) {
            $this->command->error('Bihar state not found. Run StateSeeder first.');
            return;
        }

        // Resolve category IDs by slug
        $cats = [];
        foreach (['education', 'health', 'agriculture', 'housing', 'employment', 'social-welfare', 'women-child', 'financial-inclusion', 'digital-india', 'infrastructure', 'environment', 'senior-citizen'] as $slug) {
            $cat = Category::where('slug', $slug)->first();
            if ($cat) {
                $cats[$slug] = $cat->id;
            }
        }

        $schemes = [

            // SOURCE: https://serviceonline.bihar.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Saat Nishchay Yojana (Bihar)',
                'slug' => 'saat-nishchay-yojana-bihar',
                'category_id' => $cats['social-welfare'] ?? null,
                'state_id' => 5,
                'short_description' => 'Chief Minister 7-point governance resolve for Bihar covering pucca houses, all-weather roads, clean drinking water, toilets, electricity, clean drains and greenery.',
                'title_hi' => 'सात निश्चय योजना (बिहार)',
                'short_description_hi' => 'मुख्यमंत्री का 7 सूत्री शासन संकल्प: पक्के मकान, सभी मौसम की सड़क, स्वच्छ पेयजल, शौचालय, बिजली, साफ नालियां व हरियाली।',
                'content' => '<p>Saat Nishchay (the "Seven Resolves") is a flagship governance programme of the Bihar government aimed at inclusive development of every gram panchayat and ward. It guarantees basic public services to citizens.</p>
<h3>The 7 Resolves</h3>
<ul>
<li>Ghar Tak Pakki Sadak - pucca road to every home</li>
<li>Har Ghar Nal Ka Jal - piped drinking water to every home</li>
<li>Sauchalay Nirman - household toilets</li>
<li>Nishchay Matritva - safe motherhood and child health</li>
<li>Kushal Yuva - skill training for youth</li>
<li>Student Credit Card - education loan support</li>
<li>Greenery and clean environment in every settlement</li>
</ul>
<h3>Objective</h3>
<p>To deliver universal basic infrastructure and services so that no household in Bihar is left without roads, water, toilets, electricity and a clean environment.</p>',
                'eligibility' => 'Citizens of Bihar at the gram panchayat / ward level; benefits are delivered through respective government departments and local bodies as per scheme-specific criteria.',
                'benefits' => 'Universal public services: all-weather roads, piped drinking water, household toilets, electricity, safe motherhood support, youth skill training and a clean green environment.',
                'application_process' => '1. Schemes are implemented through concerned departments and local bodies (Panchayat / Urban bodies)
2. Citizens can access related services via the Bihar service portal https://serviceonline.bihar.gov.in
3. Apply / register under the relevant component as notified
4. Verification and execution by the department / local body',
                'required_documents' => 'Varies by component; generally Aadhaar Card, Bihar residence proof, land / house details, bank account details as applicable.',
                'official_website' => 'https://serviceonline.bihar.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => true,
                'meta_title' => 'Saat Nishchay Yojana Bihar - 7 Resolves of Bihar Government',
                'meta_description' => 'Saat Nishchay (7 Resolves) is the Bihar governments flagship programme for pucca houses, roads, water, toilets, electricity and greenery. Check details.',
            ],

            // SOURCE: https://serviceonline.bihar.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Bihar Student Credit Card Scheme (BSCC)',
                'slug' => 'bihar-student-credit-card-bihar',
                'category_id' => $cats['education'] ?? null,
                'state_id' => 5,
                'short_description' => 'Education loan of up to Rs. 4 lakh to Bihar students for pursuing higher and professional studies, with the state as guarantor.',
                'title_hi' => 'बिहार स्टूडेंट क्रेडिट कार्ड योजना (BSCC)',
                'short_description_hi' => 'उच्च व पेशेवर शिक्षा हेतु बिहार के विद्यार्थियों को 4 लाख रुपये तक का शैक्षणिक ऋण, राज्य को गारंटर बनाकर।',
                'content' => '<p>Bihar Student Credit Card Scheme (BSCC) is a flagship education scheme of the Bihar government to help students pursue higher and professional education without financial hardship. The state government acts as a guarantor for the education loan.</p>
<h3>Key Features</h3>
<ul>
<li>Education loan of up to Rs. 4 lakh</li>
<li>Covers professional courses, computer certificate courses, CA, CFA, ICWA and recognised higher studies</li>
<li>Loan disbursed through the Bihar Education Finance Corporation</li>
<li>Repayment begins after course completion with a grace period</li>
</ul>
<h3>Objective</h3>
<p>To raise the state Gross Enrollment Ratio (GER) for higher education by removing the cost barrier for meritorious students.</p>',
                'eligibility' => 'Bihar resident students who have passed 12th standard and secured admission in a recognised institution for higher / professional studies. Age and other criteria are as per the official portal.',
                'benefits' => 'Education loan of up to Rs. 4 lakh with the state government as guarantor, covering tuition and course-related expenses for higher / professional studies.',
                'application_process' => '1. Visit the Bihar service portal https://serviceonline.bihar.gov.in
2. Locate the Student Credit Card (BSCC) service
3. Register and fill in academic and admission details
4. Upload the required documents
5. Submit and complete verification as notified
6. Loan sanctioned and disbursed by the Education Finance Corporation',
                'required_documents' => 'Aadhaar Card, 12th marksheet, admission proof in recognised institution, bank account details, income / residence proof, passport-size photograph.',
                'official_website' => 'https://serviceonline.bihar.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => true,
                'meta_title' => 'Bihar Student Credit Card Yojana (BSCC) - Rs. 4 Lakh Education Loan',
                'meta_description' => 'Bihar Student Credit Card Yojana offers up to Rs. 4 lakh education loan to students for higher studies. Check eligibility, apply online, documents.',
            ],

            // SOURCE: https://serviceonline.bihar.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Jeevika (Bihar Rural Livelihoods Promotion Society - BRLPS)',
                'slug' => 'jeevika-brlps-bihar',
                'category_id' => $cats['financial-inclusion'] ?? null,
                'state_id' => 5,
                'short_description' => 'One of the world largest rural livelihoods programmes, forming women self-help groups (SHGs) in Bihar for credit, livelihood and entrepreneurship.',
                'title_hi' => 'जीविका (बिहार ग्रामीण आजीविका संवर्धन समिति - BRLPS)',
                'short_description_hi' => 'विश्व के सबसे बड़े ग्रामीण आजीविका कार्यक्रमों में से एक, बिहार में महिला स्वयं सहायता समूह (SHG) बनाकर ऋण, आजीविका व उद्यमिता का संवर्धन।',
                'content' => '<p>Jeevika is the Bihar Rural Livelihoods Promotion Society (BRLPS), the implementing agency under the Bihar Rural Livelihoods Project. It is among the largest rural livelihoods initiatives in the world, organising rural women into self-help groups (SHGs) for access to credit, livelihoods and entrepreneurship.</p>
<h3>Key Features</h3>
<ul>
<li>Formation and strengthening of women self-help groups (SHGs) and their federations</li>
<li>Access to bank credit and livelihood diversification</li>
<li>Support for farm and non-farm enterprises</li>
<li>Convergence with state schemes for women and rural development</li>
</ul>',
                'eligibility' => 'Rural women of Bihar who join or form a self-help group (SHG) under the Jeevika programme. Membership and group formation norms are as per BRLPS.',
                'benefits' => 'Institutional support, access to group savings and bank credit, livelihood training and entrepreneurship support for rural women.',
                'application_process' => '1. Contact the nearest Jeevika block / cluster resource centre in your area
2. Form or join a women self-help group (SHG)
3. Open group / member bank account and begin savings
4. Access credit and livelihood linkages through the SHG federation
5. Details and updates on the Bihar service portal https://serviceonline.bihar.gov.in',
                'required_documents' => 'Aadhaar Card, Bihar residence proof, bank account details, SHG membership particulars.',
                'official_website' => 'https://serviceonline.bihar.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => true,
                'meta_title' => 'Jeevika Bihar (BRLPS) - Rural Livelihoods & Women SHG Mission',
                'meta_description' => 'Jeevika (BRLPS) is Bihars rural livelihoods mission forming women SHGs for credit and entrepreneurship. Learn about eligibility and benefits.',
            ],

            // SOURCE: https://serviceonline.bihar.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Mukhyamantri Kanya Suraksha Yojana (Bihar)',
                'slug' => 'mukhyamantri-kanya-suraksha-yojana-bihar',
                'category_id' => $cats['women-child'] ?? null,
                'state_id' => 5,
                'short_description' => 'Girl-child and marriage-support scheme of Bihar providing financial assistance / incentive to families with a girl child (as per official portal).',
                'title_hi' => 'मुख्यमंत्री कन्या सुरक्षा योजना (बिहार)',
                'short_description_hi' => 'बिहार की बालिका व विवाह सहायता योजना जो बालिका वाले परिवारों को वित्तीय सहायता / प्रोत्साहन देती है (आधिकारिक पोर्टलानुसार)।',
                'content' => '<p>Mukhyamantri Kanya Suraksha Yojana is a Bihar government scheme aimed at the welfare and security of the girl child and her family, including support linked to the birth and marriage of a girl child. The scheme is implemented by the Women Development Corporation, Bihar.</p>
<h3>Key Features</h3>
<ul>
<li>Financial assistance / incentive for families with a girl child</li>
<li>Support linked to birth registration and marriage of the girl child</li>
<li>Implemented through the Women Development Corporation, Patna</li>
</ul>
<p>Exact amounts and eligibility criteria are as per the official notification on the state portal.</p>',
                'eligibility' => 'Girl children of Bihar families as per the criteria notified by the Women Development Corporation / Social Welfare Department. Family and documentation conditions are as per the official portal.',
                'benefits' => 'Financial assistance / incentive to eligible families with a girl child, as per official rates published on the portal.',
                'application_process' => '1. Visit the Bihar service portal https://serviceonline.bihar.gov.in
2. Locate the Kanya Suraksha Yojana service
3. Register and submit the application with documents
4. Verification by the department
5. Assistance released as per norms',
                'required_documents' => 'Birth certificate of the girl child, BPL / income certificate, Aadhaar Card, parent identity proof, bank account details.',
                'official_website' => 'https://serviceonline.bihar.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Mukhyamantri Kanya Suraksha Yojana Bihar - Girl Child Scheme',
                'meta_description' => 'Bihar Mukhyamantri Kanya Suraksha Yojana provides girl-child and marriage support. Check eligibility and apply online.',
            ],

            // SOURCE: https://serviceonline.bihar.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Bihar Agriculture Road Map',
                'slug' => 'bihar-agriculture-road-map-bihar',
                'category_id' => $cats['agriculture'] ?? null,
                'state_id' => 5,
                'short_description' => 'State agriculture policy providing farmer support, input subsidy and irrigation development to raise farm productivity in Bihar (as per official portal).',
                'title_hi' => 'बिहार कृषि रोड मैप',
                'short_description_hi' => 'राज्य की कृषि नीति जो किसान सहायता, इनपुट सब्सिडी व सिंचाई विकास प्रदान कर कृषि उत्पादकता बढ़ाती है (आधिकारिक पोर्टलानुसार)।',
                'content' => '<p>The Bihar Agriculture Road Map is the state agriculture policy framework that guides farmer support, input subsidy, irrigation expansion and crop diversification to increase agricultural productivity and farmer income across Bihar.</p>
<h3>Key Features</h3>
<ul>
<li>Farmer support and agricultural input subsidy</li>
<li>Irrigation development and water-use efficiency</li>
<li>Promotion of better seeds, technology and crop diversification</li>
<li>Convergence with central schemes such as PM-KISAN where applicable</li>
</ul>
<p>Exact subsidy amounts and eligibility are as per the official agriculture department notification.</p>',
                'eligibility' => 'Farmers of Bihar cultivating notified crops and meeting the land / registration criteria prescribed by the Agriculture Department on the official portal.',
                'benefits' => 'Farmer support, input subsidy and irrigation development to improve productivity and income, as per official rates.',
                'application_process' => '1. Visit the Bihar service portal https://serviceonline.bihar.gov.in
2. Locate the agriculture / farmer-support service
3. Register as a farmer and submit land and crop details
4. Upload the required documents
5. Verification by the department and release of benefits',
                'required_documents' => 'Aadhaar Card, land records / Khasra-Khatauni, bank account details, crop sowing details, farmer registration proof.',
                'official_website' => 'https://serviceonline.bihar.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Bihar Agriculture Road Map - Farmer Support & Subsidy',
                'meta_description' => 'Bihar Agriculture Road Map provides farmer support, input subsidy and irrigation. Check eligibility and apply online.',
            ],

            // SOURCE: https://serviceonline.bihar.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Mukhyamantri Nishchay Swayam Sahayata Bhatta (Bihar)',
                'slug' => 'mukhyamantri-nishchay-swayam-sahayata-bhatta-bihar',
                'category_id' => $cats['employment'] ?? null,
                'state_id' => 5,
                'short_description' => 'Monthly unemployment allowance of Rs. 1,000 - Rs. 1,500 to educated unemployed youth of Bihar during their job search.',
                'title_hi' => 'मुख्यमंत्री निश्चय स्वयं सहायता भत्ता (बिहार)',
                'short_description_hi' => 'बिहार के शिक्षित बेरोजगार युवाओं को रोजगार खोज के दौरान 1,000 - 1,500 रुपये प्रति माह की बेरोजगारी भत्ता।',
                'content' => '<p>Mukhyamantri Nishchay Swayam Sahayata Bhatta Yojana (MNSSBY) is a Bihar government scheme to support educated unemployed youth during their job search and skill development.</p>
<h3>Key Features</h3>
<ul>
<li>Monthly unemployment allowance to educated unemployed youth</li>
<li>Provided for a defined period while the beneficiary seeks employment</li>
<li>Linked with skill training and registration on the state portal</li>
</ul>
<h3>Objective</h3>
<p>To provide financial support to unemployed youth so they are not forced into distress while seeking employment.</p>',
                'eligibility' => 'Bihar residents who are educated unemployed youth meeting the qualification and age criteria notified on the official portal. Registration and verification are completed as per department norms.',
                'benefits' => 'Rs. 1,000 - Rs. 1,500 per month as unemployment allowance, transferred to the beneficiary bank account for the notified period.',
                'application_process' => '1. Visit the Bihar service portal https://serviceonline.bihar.gov.in
2. Locate the Swayam Sahayata Bhatta service
3. Register and fill in personal and academic details
4. Upload the required documents
5. Complete verification as notified
6. Monthly allowance credited to the bank account after approval',
                'required_documents' => 'Aadhaar Card, educational certificates, bank account details, Bihar residence proof, registration as notified.',
                'official_website' => 'https://serviceonline.bihar.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Mukhyamantri Swayam Sahayata Bhatta Bihar - Unemployment Allowance',
                'meta_description' => 'Bihar Mukhyamantri Nishchay Swayam Sahayata Bhatta gives Rs. 1,000-1,500/month to unemployed youth. Check eligibility, apply online.',
            ],

            // SOURCE: https://serviceonline.bihar.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Bihar Old Age Pension Scheme',
                'slug' => 'bihar-old-age-pension-bihar',
                'category_id' => $cats['social-welfare'] ?? null,
                'state_id' => 5,
                'short_description' => 'Monthly pension to eligible senior citizens of Bihar under the state social security programme (as per official portal).',
                'title_hi' => 'बिहार वृद्धावस्था पेंशन योजना',
                'short_description_hi' => 'बिहार के पात्र वरिष्ठ नागरिकों को राज्य सामाजिक सुरक्षा कार्यक्रम के अंतर्गत मासिक पेंशन (आधिकारिक पोर्टलानुसार)।',
                'content' => '<p>The Bihar Old Age Pension Scheme is a social security programme of the Bihar government providing a monthly pension to eligible senior citizens so they have a steady income in old age.</p>
<h3>Key Features</h3>
<ul>
<li>Monthly pension to eligible senior citizens</li>
<li>Implemented through the Social Welfare Department, Bihar</li>
<li>Direct Benefit Transfer (DBT) to the beneficiary bank account</li>
</ul>
<p>The pension amount and eligibility criteria are as notified by the department on the official portal.</p>',
                'eligibility' => 'Resident senior citizens of Bihar meeting the age and income / family-status conditions prescribed by the Social Welfare Department. Beneficiaries already receiving another state / central pension are generally not eligible.',
                'benefits' => 'Monthly old-age pension as per the Bihar Social Welfare Department rates, credited directly to the beneficiary bank account via DBT.',
                'application_process' => '1. Visit the Bihar service portal https://serviceonline.bihar.gov.in
2. Locate the old age pension service
3. Register / apply and verify Aadhaar
4. Submit age and residence documents
5. Verification by the department and activation of pension',
                'required_documents' => 'Aadhaar Card, age proof (birth certificate / certificate from competent authority), bank account details, Bihar residence proof.',
                'official_website' => 'https://serviceonline.bihar.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Bihar Old Age Pension Scheme - Monthly Pension for Senior Citizens',
                'meta_description' => 'Bihar Old Age Pension Scheme provides a monthly pension to senior citizens. Check eligibility, apply online and track status.',
            ],

            // SOURCE: https://serviceonline.bihar.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Mukhyamantri Awas Yojana Bihar',
                'slug' => 'mukhyamantri-awas-yojana-bihar',
                'category_id' => $cats['housing'] ?? null,
                'state_id' => 5,
                'short_description' => 'Housing scheme providing pucca houses to poor and eligible families of Bihar (as per official portal).',
                'title_hi' => 'मुख्यमंत्री आवास योजना बिहार',
                'short_description_hi' => 'बिहार के गरीब व पात्र परिवारों को पक्का मकान देने वाली आवास योजना (आधिकारिक पोर्टलानुसार)।',
                'content' => '<p>Mukhyamantri Awas Yojana Bihar is the state housing initiative to provide pucca houses and financial assistance to eligible poor and weaker-section families in Bihar.</p>
<h3>Key Features</h3>
<ul>
<li>Pucca house / financial assistance to eligible families</li>
<li>Convergent with PM Awas Yojana where applicable</li>
<li>Ownership preferential in the name of the woman of the household</li>
</ul>
<p>Assistance amount and eligibility are as per the official notification.</p>',
                'eligibility' => 'Poor / weaker-section families of Bihar as per the housing department income and deprivation norms on the official portal.',
                'benefits' => 'Pucca house / financial assistance to eligible families, released in instalments as per official norms.',
                'application_process' => '1. Visit the Bihar service portal https://serviceonline.bihar.gov.in
2. Locate the housing / Awas Yojana service
3. Apply and submit income, residence and eligibility documents
4. Verification by the department / local body
5. Assistance released after approval',
                'required_documents' => 'Aadhaar Card, residence proof, income certificate, bank details, priority category proof (if any).',
                'official_website' => 'https://serviceonline.bihar.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Mukhyamantri Awas Yojana Bihar - Housing for Poor Families',
                'meta_description' => 'Mukhyamantri Awas Yojana Bihar provides pucca houses to poor families. Check eligibility and apply online.',
            ],

            // SOURCE: https://serviceonline.bihar.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Mukhyamantri Chikitsa Sahayata Yojana (Bihar)',
                'slug' => 'mukhyamantri-chikitsa-sahayata-bihar',
                'category_id' => $cats['health'] ?? null,
                'state_id' => 5,
                'short_description' => 'Free / assisted medical treatment to eligible residents at government hospitals in Bihar (as per official portal).',
                'title_hi' => 'मुख्यमंत्री चिकित्सा सहायता योजना (बिहार)',
                'short_description_hi' => 'बिहार के पात्र निवासियों को सरकारी अस्पतालों में निःशुल्क / सहायता प्राप्त चिकित्सा उपचार (आधिकारिक पोर्टलानुसार)।',
                'content' => '<p>Mukhyamantri Chikitsa Sahayata Yojana is a Bihar government health-assistance scheme to provide free or subsidised treatment to eligible residents at government hospitals.</p>
<h3>Key Features</h3>
<ul>
<li>Free / assisted treatment at government hospitals</li>
<li>Support for specified medical conditions as per the scheme</li>
<li>Managed through the state health department framework</li>
</ul>
<p>Covered treatments and assistance amounts are as per the official notification.</p>',
                'eligibility' => 'Residents of Bihar meeting the eligibility and income criteria notified by the Health Department for the specified treatments.',
                'benefits' => 'Free or assisted medical treatment at government hospitals, as per the official scheme norms.',
                'application_process' => '1. Visit the Bihar service portal https://serviceonline.bihar.gov.in
2. Locate the Chikitsa Sahayata / health-assistance service
3. Register and submit medical and eligibility documents
4. Verification / referral by the department / hospital
5. Treatment availed at the empanelled government hospital',
                'required_documents' => 'Aadhaar Card, Bihar residence proof, income / eligibility proof, medical documents as applicable, bank account details.',
                'official_website' => 'https://serviceonline.bihar.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Mukhyamantri Chikitsa Sahayata Yojana Bihar - Free Treatment',
                'meta_description' => 'Bihar Mukhyamantri Chikitsa Sahayata Yojana provides free / assisted treatment. Check eligibility and apply online.',
            ],

            // SOURCE: https://serviceonline.bihar.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Balika Protsahan Yojana (Bihar)',
                'slug' => 'balika-protsahan-yojana-bihar',
                'category_id' => $cats['education'] ?? null,
                'state_id' => 5,
                'short_description' => 'Incentive scheme encouraging the education of the girl child in Bihar (as per official portal).',
                'title_hi' => 'बालिका प्रोत्साहन योजना (बिहार)',
                'short_description_hi' => 'बिहार में बालिका शिक्षा को प्रोत्साहित करने वाली प्रोत्साहन योजना (आधिकारिक पोर्टलानुसार)।',
                'content' => '<p>Balika Protsahan Yojana is a Bihar government scheme to encourage the education of the girl child by providing a financial incentive on continuation of studies.</p>
<h3>Key Features</h3>
<ul>
<li>Financial incentive to girls for education</li>
<li>Aimed at reducing dropout among girls</li>
<li>Promotes continuation of education up to higher classes</li>
</ul>
<p>Exact incentive amounts and eligibility are as per the official notification on the state portal.</p>',
                'eligibility' => 'Girl students of Bihar who meet the class / attendance criteria notified by the Education Department on the official portal.',
                'benefits' => 'Financial incentive to encourage the education of the girl child, as per official rates published on the portal.',
                'application_process' => '1. Visit the Bihar service portal https://serviceonline.bihar.gov.in
2. Locate the Balika Protsahan Yojana service
3. Register and submit academic and bank details
4. Verification by the department / school
5. Incentive released as per norms',
                'required_documents' => 'Aadhaar Card, school enrolment / mark sheet, bank account details, Bihar residence proof.',
                'official_website' => 'https://serviceonline.bihar.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Balika Protsahan Yojana Bihar - Girl Education Incentive',
                'meta_description' => 'Bihar Balika Protsahan Yojana gives incentives for girl education. Check eligibility and apply online.',
            ],

            // SOURCE: https://serviceonline.bihar.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Bihar Kanya Vivah Yojana',
                'slug' => 'bihar-kanya-vivah-yojana-bihar',
                'category_id' => $cats['women-child'] ?? null,
                'state_id' => 5,
                'short_description' => 'Marriage grant / assistance to poor families of Bihar for the marriage of their daughter (as per official portal).',
                'title_hi' => 'बिहार कन्या विवाह योजना',
                'short_description_hi' => 'बिहार के गरीब परिवारों की बेटी के विवाह हेतु विवाह अनुदान / सहायता (आधिकारिक पोर्टलानुसार)।',
                'content' => '<p>Bihar Kanya Vivah Yojana is a state scheme to support the marriage of daughters from poor and weaker-section families by providing a marriage grant / assistance.</p>
<h3>Key Features</h3>
<ul>
<li>Financial grant / assistance for the marriage of an eligible girl</li>
<li>Aimed at reducing the financial burden of marriage on poor families</li>
<li>Implemented through the Social Welfare / Women Welfare Department, Bihar</li>
</ul>
<p>The grant amount and eligibility are as per the official notification.</p>',
                'eligibility' => 'Daughters of poor / weaker-section families of Bihar within the income and documentation criteria prescribed on the official portal.',
                'benefits' => 'Marriage grant / financial assistance to eligible families for the marriage of their daughter, as per official rates.',
                'application_process' => '1. Visit the Bihar service portal https://serviceonline.bihar.gov.in
2. Locate the Kanya Vivah Yojana service
3. Register and submit income, residence and daughter documents
4. Verification by the department
5. Grant released after approval',
                'required_documents' => 'Daughter birth certificate, family income certificate, residence proof, bank details, Aadhaar, photographs.',
                'official_website' => 'https://serviceonline.bihar.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Bihar Kanya Vivah Yojana - Marriage Grant for Poor Families',
                'meta_description' => 'Bihar Kanya Vivah Yojana provides a marriage grant to poor families. Check eligibility and apply online.',
            ],

            // SOURCE: https://serviceonline.bihar.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Jeevika Sakhi Mandal (Women SHG Bank Linkage, Bihar)',
                'slug' => 'jeevika-sakhi-mandal-shg-bihar',
                'category_id' => $cats['financial-inclusion'] ?? null,
                'state_id' => 5,
                'short_description' => 'Women self-help group (SHG) bank-linkage programme under Jeevika providing credit and financial inclusion to rural women (as per official portal).',
                'title_hi' => 'जीविका सखी मंडल (महिला SHG बैंक लिंकेज, बिहार)',
                'short_description_hi' => 'जीविका के अंतर्गत महिला स्वयं सहायता समूह (SHG) बैंक लिंकेज कार्यक्रम जो ग्रामीण महिलाओं को ऋण व वित्तीय समावेशन देता है (आधिकारिक पोर्टलानुसार)।',
                'content' => '<p>Jeevika Sakhi Mandal is the women self-help group (SHG) bank-linkage component of the Jeevika mission in Bihar. It connects women SHGs to the formal banking system for savings, credit and financial inclusion.</p>
<h3>Key Features</h3>
<ul>
<li>Bank linkage of women SHGs for savings and credit</li>
<li>Group and member-level loans for livelihoods</li>
<li>Financial literacy and inclusion of rural women</li>
<li>Convergence with Jeevika / BRLPS institutions</li>
</ul>',
                'eligibility' => 'Rural women of Bihar who are members of a Jeevika self-help group (SHG / Sakhi Mandal) as per BRLPS norms.',
                'benefits' => 'Access to bank credit, group savings and financial inclusion support for rural women SHGs, as per official norms.',
                'application_process' => '1. Join / form a women SHG (Sakhi Mandal) under the Jeevika programme
2. Open the group bank account and maintain regular savings
3. Approach the linked bank branch for credit linkage
4. Avail group / member loans for livelihood activities
5. Details on the Bihar service portal https://serviceonline.bihar.gov.in',
                'required_documents' => 'Aadhaar Card, SHG membership particulars, group bank account details, Bihar residence proof.',
                'official_website' => 'https://serviceonline.bihar.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Jeevika Sakhi Mandal Bihar - Women SHG Bank Linkage',
                'meta_description' => 'Jeevika Sakhi Mandal links women SHGs to banks for credit and financial inclusion in Bihar. Learn about eligibility and benefits.',
            ],
        ];

        foreach ($schemes as $scheme) {
            Scheme::updateOrCreate(
                ['slug' => $scheme['slug']],
                $scheme
            );
        }

        $this->command->info('StateSchemesBiharSeeder: inserted/updated ' . count($schemes) . ' Bihar schemes (state_id=5).');
    }
}
