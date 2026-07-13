<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Scheme;
use App\Models\State;
use Illuminate\Database\Seeder;

class StateSchemesMadhyaPradeshSeeder extends Seeder
{
    public function run(): void
    {
        // Madhya Pradesh state (slug 'madhya-pradesh', id = 14)
        $state = State::where('slug', 'madhya-pradesh')->first();

        if (! $state) {
            $this->command->error('Madhya Pradesh state not found. Run StateSeeder first.');
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

            // SOURCE: https://www.mp.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Ladli Behna Yojana (Madhya Pradesh)',
                'slug' => 'ladli-behna-yojana-mp',
                'category_id' => $cats['women-child'] ?? null,
                'state_id' => 14,
                'short_description' => 'Monthly financial assistance of Rs. 1,250 to eligible married women of Madhya Pradesh to support their social and economic independence.',
                'title_hi' => 'लाडली बहना योजना (मध्य प्रदेश)',
                'short_description_hi' => 'मध्य प्रदेश की पात्र विवाहित महिलाओं को उनकी सामाजिक व आर्थिक स्वतंत्रता के लिए प्रतिमाह 1,250 रुपये की वित्तीय सहायता।',
                'content' => '<p>Ladli Behna Yojana is a flagship women-welfare scheme of the Madhya Pradesh government providing monthly financial assistance to eligible married women of the state. The amount is transferred directly to the beneficiary bank account.</p>
<h3>Key Features</h3>
<ul>
<li>Monthly financial assistance of Rs. 1,250 to eligible married women</li>
<li>Direct Benefit Transfer (DBT) to the beneficiary bank account</li>
<li>Aimed at improving the health, nutrition and economic status of women</li>
<li>Women aged 21-60 years from eligible families are covered</li>
</ul>
<h3>Objective</h3>
<p>To make women of Madhya Pradesh socially and economically self-reliant and to strengthen their role in family decision-making.</p>',
                'eligibility' => 'Married women of Madhya Pradesh aged 21-60 years belonging to eligible families as per the notified income and residence criteria. Exclusions apply as per the official portal.',
                'benefits' => 'Rs. 1,250 per month as financial assistance, credited directly to the beneficiary bank account via DBT.',
                'application_process' => '1. Visit the official Madhya Pradesh portal https://www.mp.gov.in
2. Locate the Ladli Behna Yojana service
3. Register and fill in personal, family and bank details
4. Upload the required documents
5. Verification by the department
6. Assistance credited monthly after approval',
                'required_documents' => 'Aadhaar Card, Madhya Pradesh residence proof, bank account details, marriage certificate, income / eligibility proof as applicable.',
                'official_website' => 'https://www.mp.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => true,
                'meta_title' => 'Ladli Behna Yojana MP - Rs. 1,250 Monthly to Women',
                'meta_description' => 'Madhya Pradesh Ladli Behna Yojana gives Rs. 1,250/month to eligible married women. Check eligibility, benefits and apply online.',
            ],

            // SOURCE: https://www.mp.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Mukhyamantri Kisan Kalyan Yojana (Madhya Pradesh)',
                'slug' => 'mukhyamantri-kisan-kalyan-yojana-mp',
                'category_id' => $cats['agriculture'] ?? null,
                'state_id' => 14,
                'short_description' => 'State top-up of Rs. 4,000 per year to farmers of Madhya Pradesh over and above the central PM-KISAN amount of Rs. 6,000.',
                'title_hi' => 'मुख्यमंत्री किसान कल्याण योजना (मध्य प्रदेश)',
                'short_description_hi' => 'केंद्रीय PM-KISAN की 6,000 रुपये के अतिरिक्त मध्य प्रदेश के किसानों को वार्षिक 4,000 रुपये की राज्य अनुपूरक सहायता।',
                'content' => '<p>Mukhyamantri Kisan Kalyan Yojana is a Madhya Pradesh government scheme that provides an additional annual top-up to farmers over and above the central PM-KISAN instalments.</p>
<h3>Key Features</h3>
<ul>
<li>State top-up of Rs. 4,000 per year to eligible farmers</li>
<li>In addition to the central PM-KISAN benefit of Rs. 6,000 per year (total Rs. 10,000 per year)</li>
<li>Direct Benefit Transfer (DBT) to the farmer bank account</li>
<li>Convergent with PM-KISAN registration of the state</li>
</ul>
<h3>Objective</h3>
<p>To supplement farmer income and provide additional financial support to landholding farmers of Madhya Pradesh.</p>',
                'eligibility' => 'Farmers of Madhya Pradesh who are eligible under PM-KISAN and meet the state landholding and residence criteria as notified on the official portal.',
                'benefits' => 'Rs. 4,000 per year as state top-up (over and above PM-KISAN Rs. 6,000), totalling Rs. 10,000 per year, transferred via DBT.',
                'application_process' => '1. Visit the official Madhya Pradesh portal https://www.mp.gov.in
2. Locate the Mukhyamantri Kisan Kalyan Yojana service
3. Register / link your PM-KISAN and bank details
4. Verify Aadhaar and land records
5. Benefit credited after verification',
                'required_documents' => 'Aadhaar Card, PM-KISAN registration number, land records, bank account details, Madhya Pradesh residence proof.',
                'official_website' => 'https://www.mp.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => true,
                'meta_title' => 'Mukhyamantri Kisan Kalyan Yojana MP - Rs. 4,000/Year Top-up',
                'meta_description' => 'Madhya Pradesh Mukhyamantri Kisan Kalyan Yojana gives Rs. 4,000/year top-up over PM-KISAN. Check eligibility and apply online.',
            ],

            // SOURCE: https://www.mp.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Sambal Yojana (Madhya Pradesh)',
                'slug' => 'sambal-yojana-mp',
                'category_id' => $cats['social-welfare'] ?? null,
                'state_id' => 14,
                'short_description' => 'Electricity bill relief scheme for BPL families of Madhya Pradesh providing subsidised / waived power bills (as per official portal).',
                'title_hi' => 'संबल योजना (मध्य प्रदेश)',
                'short_description_hi' => 'मध्य प्रदेश के BPL परिवारों के लिए बिजली बिल राहत योजना जो सब्सिडी / माफी प्रदान करती है (आधिकारिक पोर्टलानुसार)।',
                'content' => '<p>Sambal Yojana is a Madhya Pradesh government scheme providing relief on electricity bills to Below Poverty Line (BPL) and eligible poor families of the state.</p>
<h3>Key Features</h3>
<ul>
<li>Subsidised / waived electricity bills for eligible BPL families</li>
<li>Implemented through the state power / welfare departments</li>
<li>Benefit linked to the registered consumer number of the household</li>
</ul>
<p>Exact subsidy rates and eligibility are as per the official notification on the state portal.</p>',
                'eligibility' => 'BPL and eligible poor families of Madhya Pradesh meeting the income and residence criteria prescribed on the official portal.',
                'benefits' => 'Relief on electricity bills (subsidy / waiver) as per official rates published on the portal.',
                'application_process' => '1. Visit the official Madhya Pradesh portal https://www.mp.gov.in
2. Locate the Sambal Yojana service
3. Register and provide the electricity consumer number and family details
4. Upload income / eligibility documents
5. Verification by the department and benefit applied',
                'required_documents' => 'Aadhaar Card, BPL / income certificate, electricity consumer number, bank account details, Madhya Pradesh residence proof.',
                'official_website' => 'https://www.mp.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => true,
                'meta_title' => 'Sambal Yojana MP - Electricity Bill Relief for BPL Families',
                'meta_description' => 'Madhya Pradesh Sambal Yojana provides electricity bill relief to BPL families. Check eligibility and apply online.',
            ],

            // SOURCE: https://www.mp.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Mukhyamantri Teerth Darshan Yojana (Madhya Pradesh)',
                'slug' => 'mukhyamantri-teerth-darshan-yojana-mp',
                'category_id' => $cats['social-welfare'] ?? null,
                'state_id' => 14,
                'short_description' => 'Free pilgrimage to selected religious places for senior citizens of Madhya Pradesh (as per official portal).',
                'title_hi' => 'मुख्यमंत्री तीर्थ दर्शन योजना (मध्य प्रदेश)',
                'short_description_hi' => 'मध्य प्रदेश के वरिष्ठ नागरिकों के लिए चयनित तीर्थ स्थलों की निःशुल्क यात्रा (आधिकारिक पोर्टलानुसार)।',
                'content' => '<p>Mukhyamantri Teerth Darshan Yojana is a Madhya Pradesh government scheme offering free pilgrimage to senior citizens of the state to selected religious and cultural destinations.</p>
<h3>Key Features</h3>
<ul>
<li>Free group pilgrimage for eligible senior citizens</li>
<li>Travel, stay and meals arranged by the state</li>
<li>Destinations notified by the department from time to time</li>
</ul>
<p>Eligibility and the list of covered destinations are as per the official notification.</p>',
                'eligibility' => 'Senior citizens of Madhya Pradesh meeting the age and residence criteria prescribed on the official portal. Health and family conditions may apply.',
                'benefits' => 'Free pilgrimage (travel, accommodation and meals) to notified religious / cultural destinations.',
                'application_process' => '1. Visit the official Madhya Pradesh portal https://www.mp.gov.in
2. Locate the Teerth Darshan Yojana service
3. Register and submit age and residence details
4. Verification by the department
5. Allotment of pilgrimage batch as notified',
                'required_documents' => 'Aadhaar Card, age proof, Madhya Pradesh residence proof, medical fitness certificate (if required), bank account details.',
                'official_website' => 'https://www.mp.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Mukhyamantri Teerth Darshan Yojana MP - Free Pilgrimage',
                'meta_description' => 'Madhya Pradesh Mukhyamantri Teerth Darshan Yojana offers free pilgrimage to senior citizens. Check eligibility and apply online.',
            ],

            // SOURCE: https://www.mp.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Mukhyamantri Awas Yojana (Madhya Pradesh)',
                'slug' => 'mukhyamantri-awas-yojana-mp',
                'category_id' => $cats['housing'] ?? null,
                'state_id' => 14,
                'short_description' => 'Housing scheme providing pucca houses to poor and eligible families of Madhya Pradesh (as per official portal).',
                'title_hi' => 'मुख्यमंत्री आवास योजना (मध्य प्रदेश)',
                'short_description_hi' => 'मध्य प्रदेश के गरीब व पात्र परिवारों को पक्का मकान देने वाली आवास योजना (आधिकारिक पोर्टलानुसार)।',
                'content' => '<p>Mukhyamantri Awas Yojana is the Madhya Pradesh state housing initiative to provide pucca houses and financial assistance to eligible poor and weaker-section families.</p>
<h3>Key Features</h3>
<ul>
<li>Pucca house / financial assistance to eligible families</li>
<li>Convergent with PM Awas Yojana where applicable</li>
<li>Ownership preferential in the name of the woman of the household</li>
</ul>
<p>Assistance amount and eligibility are as per the official notification.</p>',
                'eligibility' => 'Poor / weaker-section families of Madhya Pradesh as per the housing department income and deprivation norms on the official portal.',
                'benefits' => 'Pucca house / financial assistance to eligible families, released in instalments as per official norms.',
                'application_process' => '1. Visit the official Madhya Pradesh portal https://www.mp.gov.in
2. Locate the housing / Awas Yojana service
3. Apply and submit income, residence and eligibility documents
4. Verification by the department / local body
5. Assistance released after approval',
                'required_documents' => 'Aadhaar Card, residence proof, income certificate, bank details, priority category proof (if any).',
                'official_website' => 'https://www.mp.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Mukhyamantri Awas Yojana MP - Housing for Poor Families',
                'meta_description' => 'Mukhyamantri Awas Yojana MP provides pucca houses to poor families. Check eligibility and apply online.',
            ],

            // SOURCE: https://www.mp.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Medhavi Chatravritti Yojana (Madhya Pradesh)',
                'slug' => 'medhavi-chatravritti-yojana-mp',
                'category_id' => $cats['education'] ?? null,
                'state_id' => 14,
                'short_description' => 'Scholarship for meritorious students of Madhya Pradesh for higher / professional studies (as per official portal).',
                'title_hi' => 'मेधावी छात्रवृत्ति योजना (मध्य प्रदेश)',
                'short_description_hi' => 'मध्य प्रदेश के मेधावी विद्यार्थियों के उच्च / व्यावसायिक अध्ययन हेतु छात्रवृत्ति (आधिकारिक पोर्टलानुसार)।',
                'content' => '<p>Medhavi Chatravritti Yojana is a Madhya Pradesh government scholarship scheme encouraging meritorious students to pursue higher and professional education by providing financial assistance.</p>
<h3>Key Features</h3>
<ul>
<li>Scholarship to meritorious students for higher / professional studies</li>
<li>Aimed at reducing the financial barrier to quality education</li>
<li>Implemented through the state scholarship / education department</li>
</ul>
<p>Exact scholarship amounts and eligibility criteria are as per the official notification on the state portal.</p>',
                'eligibility' => 'Meritorious students of Madhya Pradesh who secure admission in recognised institutions and meet the marks / income criteria notified on the official portal.',
                'benefits' => 'Scholarship / financial assistance to meritorious students as per official rates published on the portal.',
                'application_process' => '1. Visit the official Madhya Pradesh portal https://www.mp.gov.in
2. Locate the Medhavi Chatravritti Yojana service
3. Register and submit academic and admission details
4. Upload the required documents
5. Verification and scholarship disbursal as notified',
                'required_documents' => 'Aadhaar Card, mark sheets / merit proof, admission proof, income certificate, bank account details, Madhya Pradesh residence proof.',
                'official_website' => 'https://www.mp.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Medhavi Chatravritti Yojana MP - Scholarship for Meritorious Students',
                'meta_description' => 'Madhya Pradesh Medhavi Chatravritti Yojana offers scholarships to meritorious students. Check eligibility and apply online.',
            ],

            // SOURCE: https://www.mp.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'MP Krishak Samriddhi Yojana (Madhya Pradesh)',
                'slug' => 'mp-krishak-samriddhi-yojana-mp',
                'category_id' => $cats['agriculture'] ?? null,
                'state_id' => 14,
                'short_description' => 'Input support scheme for farmers of Madhya Pradesh providing assistance for seeds, fertiliser and other inputs (as per official portal).',
                'title_hi' => 'एमपी कृषक समृद्धि योजना (मध्य प्रदेश)',
                'short_description_hi' => 'मध्य प्रदेश के किसानों के लिए बीज, उर्वरक व अन्य इनपुट हेतु सहायता योजना (आधिकारिक पोर्टलानुसार)।',
                'content' => '<p>MP Krishak Samriddhi Yojana is a Madhya Pradesh government scheme providing input support to farmers to improve agricultural productivity and income.</p>
<h3>Key Features</h3>
<ul>
<li>Input support for seeds, fertiliser and other agricultural inputs</li>
<li>Aimed at raising farm productivity and farmer income</li>
<li>Convergence with central agriculture schemes where applicable</li>
</ul>
<p>Exact support amounts and eligibility are as per the official agriculture department notification.</p>',
                'eligibility' => 'Farmers of Madhya Pradesh cultivating notified crops and meeting the land / registration criteria prescribed by the Agriculture Department on the official portal.',
                'benefits' => 'Input support / assistance for agricultural inputs as per official rates.',
                'application_process' => '1. Visit the official Madhya Pradesh portal https://www.mp.gov.in
2. Locate the Krishak Samriddhi / farmer-support service
3. Register as a farmer and submit land and crop details
4. Upload the required documents
5. Verification by the department and release of benefits',
                'required_documents' => 'Aadhaar Card, land records / Khasra-Khatauni, bank account details, crop sowing details, farmer registration proof.',
                'official_website' => 'https://www.mp.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'MP Krishak Samriddhi Yojana - Farmer Input Support',
                'meta_description' => 'MP Krishak Samriddhi Yojana provides input support to farmers. Check eligibility and apply online.',
            ],

            // SOURCE: https://www.mp.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Gaon Ki Beti / Pratibha Kiran Yojana (Madhya Pradesh)',
                'slug' => 'gaon-ki-beti-pratibha-kiran-yojana-mp',
                'category_id' => $cats['education'] ?? null,
                'state_id' => 14,
                'short_description' => 'Girl-education incentive scheme of Madhya Pradesh encouraging continuation of studies for girls (as per official portal).',
                'title_hi' => 'गांव की बेटी / प्रतिभा किरण योजना (मध्य प्रदेश)',
                'short_description_hi' => 'मध्य प्रदेश की बालिका शिक्षा प्रोत्साहन योजना जो बेटियों के अध्ययन जारी रखने को प्रोत्साहित करती है (आधिकारिक पोर्टलानुसार)।',
                'content' => '<p>Gaon Ki Beti / Pratibha Kiran Yojana is a Madhya Pradesh government scheme to encourage the education of the girl child by providing a financial incentive for continuation of studies.</p>
<h3>Key Features</h3>
<ul>
<li>Financial incentive to girls for education</li>
<li>Aimed at reducing dropout among girls</li>
<li>Promotes continuation of education up to higher classes</li>
</ul>
<p>Exact incentive amounts and eligibility are as per the official notification on the state portal.</p>',
                'eligibility' => 'Girl students of Madhya Pradesh who meet the class / residence / merit criteria notified by the Education Department on the official portal.',
                'benefits' => 'Financial incentive to encourage the education of the girl child, as per official rates published on the portal.',
                'application_process' => '1. Visit the official Madhya Pradesh portal https://www.mp.gov.in
2. Locate the Gaon Ki Beti / Pratibha Kiran Yojana service
3. Register and submit academic and bank details
4. Verification by the department / school
5. Incentive released as per norms',
                'required_documents' => 'Aadhaar Card, school enrolment / mark sheet, bank account details, Madhya Pradesh residence proof.',
                'official_website' => 'https://www.mp.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Gaon Ki Beti / Pratibha Kiran Yojana MP - Girl Education Incentive',
                'meta_description' => 'Madhya Pradesh Gaon Ki Beti / Pratibha Kiran Yojana gives incentives for girl education. Check eligibility and apply online.',
            ],

            // SOURCE: https://www.mp.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Mukhyamantri Yuva Swarozgar Yojana (Madhya Pradesh)',
                'slug' => 'mukhyamantri-yuva-swarozgar-yojana-mp',
                'category_id' => $cats['employment'] ?? null,
                'state_id' => 14,
                'short_description' => 'Self-employment scheme for the youth of Madhya Pradesh providing financial and training support to start enterprises (as per official portal).',
                'title_hi' => 'मुख्यमंत्री युवा स्वरोजगार योजना (मध्य प्रदेश)',
                'short_description_hi' => 'मध्य प्रदेश के युवाओं के लिए स्वरोजगार योजना जो उद्यम शुरू करने हेतु वित्तीय व प्रशिक्षण सहायता देती है (आधिकारिक पोर्टलानुसार)।',
                'content' => '<p>Mukhyamantri Yuva Swarozgar Yojana is a Madhya Pradesh government scheme promoting self-employment among the youth by providing financial assistance and training support to set up enterprises.</p>
<h3>Key Features</h3>
<ul>
<li>Financial / subsidy support for youth to start self-employment ventures</li>
<li>Training and handholding for enterprise setup</li>
<li>Aimed at reducing youth unemployment in the state</li>
</ul>
<p>Exact subsidy amounts and eligibility are as per the official notification.</p>',
                'eligibility' => 'Youth of Madhya Pradesh meeting the age, education, residence and enterprise criteria notified on the official portal.',
                'benefits' => 'Financial / subsidy assistance and training support for self-employment ventures, as per official norms.',
                'application_process' => '1. Visit the official Madhya Pradesh portal https://www.mp.gov.in
2. Locate the Yuva Swarozgar Yojana service
3. Register and submit business plan and eligibility details
4. Upload the required documents
5. Verification and sanction as notified',
                'required_documents' => 'Aadhaar Card, educational certificates, business plan, bank account details, Madhya Pradesh residence proof, income / category proof.',
                'official_website' => 'https://www.mp.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Mukhyamantri Yuva Swarozgar Yojana MP - Youth Self-Employment',
                'meta_description' => 'Madhya Pradesh Mukhyamantri Yuva Swarozgar Yojana supports youth self-employment. Check eligibility and apply online.',
            ],

            // SOURCE: https://www.mp.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Ladli Laxmi Yojana (Madhya Pradesh)',
                'slug' => 'ladli-laxmi-yojana-mp',
                'category_id' => $cats['women-child'] ?? null,
                'state_id' => 14,
                'short_description' => 'Girl-child deposit scheme of Madhya Pradesh building a financial corpus for the education and welfare of the girl child (as per official portal).',
                'title_hi' => 'लाडली लक्ष्मी योजना (मध्य प्रदेश)',
                'short_description_hi' => 'मध्य प्रदेश की बालिका जमा योजना जो बालिका की शिक्षा व कल्याण हेतु वित्तीय निधि का निर्माण करती है (आधिकारिक पोर्टलानुसार)।',
                'content' => '<p>Ladli Laxmi Yojana is a Madhya Pradesh government girl-child deposit scheme aimed at securing the future of the girl child through a financial corpus used for her education and welfare.</p>
<h3>Key Features</h3>
<ul>
<li>Deposit / maturity benefit for the girl child</li>
<li>Linked to birth registration and continuation of education</li>
<li>Promotes the survival, education and welfare of the girl child</li>
</ul>
<p>Exact deposit and maturity amounts and eligibility are as per the official notification.</p>',
                'eligibility' => 'Girl children of Madhya Pradesh families as per the criteria notified by the Women / Social Welfare Department on the official portal.',
                'benefits' => 'Deposit-linked financial corpus / maturity benefit for the girl child as per official rates.',
                'application_process' => '1. Visit the official Madhya Pradesh portal https://www.mp.gov.in
2. Locate the Ladli Laxmi Yojana service
3. Register the girl child and submit birth / family details
4. Upload the required documents
5. Verification and enrolment as notified',
                'required_documents' => 'Birth certificate of the girl child, parent identity proof, Aadhaar Card, bank account details, Madhya Pradesh residence proof.',
                'official_website' => 'https://www.mp.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Ladli Laxmi Yojana MP - Girl Child Deposit Scheme',
                'meta_description' => 'Madhya Pradesh Ladli Laxmi Yojana is a girl-child deposit scheme. Check eligibility and apply online.',
            ],

            // SOURCE: https://www.mp.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'MP e-District Services (Madhya Pradesh)',
                'slug' => 'mp-e-district-services-mp',
                'category_id' => $cats['digital-india'] ?? null,
                'state_id' => 14,
                'short_description' => 'Online portal of Madhya Pradesh for certificates and citizen services such as income, caste, residence and other certificates.',
                'title_hi' => 'एमपी ई-डिस्ट्रिक्ट सेवाएं (मध्य प्रदेश)',
                'short_description_hi' => 'मध्य प्रदेश का ऑनलाइन पोर्टल जो आय, जाति, निवास व अन्य प्रमाणपत्र व नागरिक सेवाएं प्रदान करता है।',
                'content' => '<p>MP e-District Services is the Madhya Pradesh government online platform for delivering citizen-centric services such as income certificates, caste certificates, residence certificates, and other government services.</p>
<h3>Key Features</h3>
<ul>
<li>Online application and tracking for certificates and services</li>
<li>Reduces the need to visit government offices physically</li>
<li>Transparent, time-bound service delivery</li>
</ul>',
                'eligibility' => 'Residents of Madhya Pradesh requiring government certificates / services as listed on the official e-District portal.',
                'benefits' => 'Convenient online access to certificates and citizen services with tracked, time-bound delivery.',
                'application_process' => '1. Visit the official Madhya Pradesh portal https://www.mp.gov.in
2. Locate the e-District / citizen services section
3. Register and select the required certificate / service
4. Fill the form and upload documents
5. Track status and download the issued certificate',
                'required_documents' => 'Aadhaar Card, Madhya Pradesh residence proof, supporting documents specific to the certificate / service requested, bank account details where applicable.',
                'official_website' => 'https://www.mp.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'MP e-District Services - Online Certificates & Citizen Services',
                'meta_description' => 'MP e-District Services offers online certificates and citizen services in Madhya Pradesh. Apply and track online.',
            ],

            // SOURCE: https://www.mp.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Madhya Pradesh Old Age / Widow Pension Scheme',
                'slug' => 'mp-old-age-widow-pension-mp',
                'category_id' => $cats['social-welfare'] ?? null,
                'state_id' => 14,
                'short_description' => 'Monthly pension to eligible senior citizens, widows and disabled persons of Madhya Pradesh under the state social security programme (as per official portal).',
                'title_hi' => 'मध्य प्रदेश वृद्धावस्था / विधवा पेंशन योजना',
                'short_description_hi' => 'मध्य प्रदेश के पात्र वरिष्ठ नागरिकों, विधवाओं व विकलांगजन को राज्य सामाजिक सुरक्षा कार्यक्रम के अंतर्गत मासिक पेंशन (आधिकारिक पोर्टलानुसार)।',
                'content' => '<p>The Madhya Pradesh Old Age / Widow / Disabled Pension Scheme is a social security programme of the state government providing a monthly pension to eligible senior citizens, widows and persons with disabilities.</p>
<h3>Key Features</h3>
<ul>
<li>Monthly pension to eligible senior citizens, widows and disabled persons</li>
<li>Implemented through the Social Justice / Social Welfare Department</li>
<li>Direct Benefit Transfer (DBT) to the beneficiary bank account</li>
</ul>
<p>The pension amount and eligibility criteria are as notified by the department on the official portal.</p>',
                'eligibility' => 'Resident senior citizens, widows and persons with disabilities of Madhya Pradesh meeting the age and income / family-status conditions prescribed by the department. Beneficiaries already receiving another state / central pension are generally not eligible.',
                'benefits' => 'Monthly pension as per the Madhya Pradesh Social Welfare Department rates, credited directly to the beneficiary bank account via DBT.',
                'application_process' => '1. Visit the official Madhya Pradesh portal https://www.mp.gov.in
2. Locate the old age / widow / disability pension service
3. Register / apply and verify Aadhaar
4. Submit age, disability and residence documents
5. Verification by the department and activation of pension',
                'required_documents' => 'Aadhaar Card, age proof, disability certificate (if applicable), bank account details, Madhya Pradesh residence proof, income certificate.',
                'official_website' => 'https://www.mp.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Madhya Pradesh Old Age / Widow Pension Scheme',
                'meta_description' => 'Madhya Pradesh Old Age / Widow Pension Scheme provides a monthly pension to eligible citizens. Check eligibility and apply online.',
            ],

            // SOURCE: https://www.mp.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Sanjivani / Mukhyamantri Health Scheme (Madhya Pradesh)',
                'slug' => 'sanjivani-mukhyamantri-health-scheme-mp',
                'category_id' => $cats['health'] ?? null,
                'state_id' => 14,
                'short_description' => 'Health cover / assistance scheme of Madhya Pradesh providing treatment support to poor and eligible families (as per official portal).',
                'title_hi' => 'संजीवनी / मुख्यमंत्री स्वास्थ्य योजना (मध्य प्रदेश)',
                'short_description_hi' => 'मध्य प्रदेश की स्वास्थ्य सुरक्षा / सहायता योजना जो गरीब व पात्र परिवारों को उपचार सहायता देती है (आधिकारिक पोर्टलानुसार)।',
                'content' => '<p>Sanjivani / Mukhyamantri Health Scheme is a Madhya Pradesh government health-assistance programme providing treatment support and health cover to poor and eligible families of the state.</p>
<h3>Key Features</h3>
<ul>
<li>Health cover / assisted treatment at empanelled hospitals</li>
<li>Aimed at reducing the financial burden of illness on poor families</li>
<li>Managed through the state health department framework</li>
</ul>
<p>Covered treatments and assistance amounts are as per the official notification.</p>',
                'eligibility' => 'Residents of Madhya Pradesh meeting the eligibility and income criteria notified by the Health Department for the specified treatments.',
                'benefits' => 'Health cover / assisted medical treatment as per the official scheme norms.',
                'application_process' => '1. Visit the official Madhya Pradesh portal https://www.mp.gov.in
2. Locate the Sanjivani / health scheme service
3. Register and submit medical and eligibility documents
4. Verification / referral by the department / hospital
5. Treatment availed at the empanelled hospital',
                'required_documents' => 'Aadhaar Card, Madhya Pradesh residence proof, income / eligibility proof, medical documents as applicable, bank account details.',
                'official_website' => 'https://www.mp.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Sanjivani / Mukhyamantri Health Scheme MP - Health Cover',
                'meta_description' => 'Madhya Pradesh Sanjivani / Mukhyamantri Health Scheme provides health cover to the poor. Check eligibility and apply online.',
            ],
        ];

        foreach ($schemes as $scheme) {
            Scheme::updateOrCreate(
                ['slug' => $scheme['slug']],
                $scheme
            );
        }

        $this->command->info('StateSchemesMadhyaPradeshSeeder: inserted/updated ' . count($schemes) . ' Madhya Pradesh schemes (state_id=14).');
    }
}
