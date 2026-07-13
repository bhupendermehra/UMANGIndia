<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Scheme;
use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StateSchemesMaharashtraSeeder extends Seeder
{
    public function run(): void
    {
        // Maharashtra state (slug 'maharashtra', id = 15)
        $state = State::where('slug', 'maharashtra')->first();

        if (! $state) {
            $this->command->error('Maharashtra state not found. Run StateSeeder first.');
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

        // NOTE: All official_website values below are set to https://mahadbt.maharashtra.gov.in
        // as a single consolidated entry point. VERIFY the exact per-scheme portal before going live
        // (web research unavailable in this agent environment).

        $schemes = [

            // SOURCE: https://mahadbt.maharashtra.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Mahatma Jyotiba Phule Jan Arogya Yojana',
                'category_id' => $cats['health'] ?? null,
                'state_id' => 15,
                'short_description' => 'Cashless health insurance cover for families holding a yellow/ orange ration card (BPL/APL) and registered farmer families of Maharashtra.',
                'title_hi' => 'महात्मा ज्योतिबा फुले जन आरोग्य योजना',
                'short_description_hi' => 'महाराष्ट्र के पीले/नारंगी राशन कार्ड (बीपीएल/एपीएल) धारक व पंजीकृत किसान परिवारों के लिए निःशुल्क स्वास्थ्य बीमा। लाभ: ₹1.5 लाख/परिवार (वरिष्ठ नागरिक व गंभीर बीमारी हेतु ₹2.5 लाख)।',
                'content' => '<p>Mahatma Jyotiba Phule Jan Arogya Yojana (MJPJAY) is the flagship cashless health insurance scheme of the Government of Maharashtra. It provides coverage for identified families (yellow/orange ration card holders and registered farmers) for specified surgeries, therapies and treatments at empanelled government and private hospitals.</p>
<h3>Key Features</h3>
<ul>
<li>Cashless treatment at empanelled hospitals across Maharashtra</li>
<li>Cover of Rs. 1.5 lakh per family per year (Rs. 2.5 lakh for senior citizens and specified critical illnesses)</li>
<li>Covers a defined package of surgeries, therapies and day-care procedures</li>
<li>Open to yellow/orange ration card holder families and registered farmer families</li>
</ul>
<h3>Objective</h3>
<p>To reduce the out-of-pocket health expenditure of poor and vulnerable families by providing access to quality secondary and tertiary care.</p>',
                'eligibility' => 'Families holding a yellow or orange ration card in Maharashtra and registered farmer families as per the state eligibility list. Beneficiaries are identified through the official portal / district administration.',
                'benefits' => 'Cashless health cover of Rs. 1.5 lakh per family per year (Rs. 2.5 lakh for senior citizens and specified critical illnesses), covering the defined package of treatments at empanelled hospitals.',
                'application_process' => '1. Check eligibility on the official portal or at the nearest district office
2. Obtain the MJPJAY card / e-card through the concerned office or facilitating centre
3. Visit an empanelled hospital with the card and documents
4. Hospital verifies eligibility and provides cashless treatment
5. Pre- and post-hospitalisation support as per package rules',
                'required_documents' => 'Aadhaar Card, yellow/orange ration card or farmer registration proof, bank account details, residence proof.',
                'official_website' => 'https://mahadbt.maharashtra.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => true,
                'meta_title' => 'Mahatma Jyotiba Phule Jan Arogya Yojana Maharashtra - Cashless Health Cover',
                'meta_description' => 'Maharashtra MJPJAY gives cashless health cover of Rs. 1.5 lakh per family (Rs. 2.5 lakh for seniors). Check eligibility, empanelled hospitals and apply.',
            ],

            // SOURCE: https://mahadbt.maharashtra.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'MahaDBT Post-Matric Scholarship',
                'category_id' => $cats['education'] ?? null,
                'state_id' => 15,
                'short_description' => 'State scholarship portal of Maharashtra for post-matric scholarships to SC/ST/OBC/Minority/SBC/VJNT and open-category students.',
                'title_hi' => 'महाDBT पोस्ट-मैट्रिक छात्रवृत्ति',
                'short_description_hi' => 'अनुसूचित जाति/जनजाति/अन्य पिछड़ा वर्ग/अल्पसंख्यक/एसबीसी/वीजेएनटी व सामान्य वर्ग के विद्यार्थियों हेतु महाराष्ट्र का राज्य छात्रवृत्ति पोर्टल। लाभ: वर्गानुसार शुल्क व वजीफा।',
                'content' => '<p>MahaDBT (Maharashtra Direct Benefit Transfer) is the unified scholarship and benefit portal of the Government of Maharashtra. The Post-Matric Scholarship component supports students from SC, ST, OBC, SBC, VJNT, Minority and (income-based) open categories who are pursuing education after matriculation.</p>
<h3>Key Features</h3>
<ul>
<li>Single-window online application for multiple state scholarship schemes</li>
<li>Coverage of tuition fee and maintenance allowance as per category and course norms</li>
<li>Direct Benefit Transfer of sanctioned amount to the student bank account</li>
<li>Renewal and fresh applications handled on the same portal</li>
</ul>
<h3>Objective</h3>
<p>To promote higher education among backward and economically weaker sections by reducing the financial burden of tuition and living costs.</p>',
                'eligibility' => 'Students of Maharashtra belonging to SC/ST/OBC/SBC/VJNT/Minority categories and income-eligible open-category students, studying in a recognised post-matriculation course, with family income within the notified limits for the respective scheme.',
                'benefits' => 'Tuition fee reimbursement and maintenance allowance (admission/fee/other allowances) as per the category- and course-specific rates notified by the state government, paid via DBT.',
                'application_process' => '1. Visit https://mahadbt.maharashtra.gov.in
2. Register and create a student profile with Aadhaar and bank details
3. Select the applicable Post-Matric scholarship scheme
4. Fill the application and upload documents
5. Submit for verification by the institute and department
6. Sanctioned amount credited to the bank account via DBT',
                'required_documents' => 'Aadhaar Card, caste / category certificate, income certificate, previous-year mark sheet, admission / fee receipt, bank account details.',
                'official_website' => 'https://mahadbt.maharashtra.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => true,
                'meta_title' => 'MahaDBT Post-Matric Scholarship Maharashtra - Apply Online',
                'meta_description' => 'MahaDBT Post-Matric Scholarship for SC/ST/OBC/Minority/Open students in Maharashtra. Check eligibility, apply online and track status.',
            ],

            // SOURCE: https://mahadbt.maharashtra.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Annapurna Yojana Maharashtra',
                'category_id' => $cats['senior-citizen'] ?? null,
                'state_id' => 15,
                'short_description' => 'Provides free food grains to senior citizens of Maharashtra who are not covered under the National Food Security Act (NFSA).',
                'title_hi' => 'अन्नपूर्णा योजना (महाराष्ट्र)',
                'short_description_hi' => 'राष्ट्रीय खाद्य सुरक्षा अधिनियम (NFSA) के दायरे में न आने वाले महाराष्ट्र के वरिष्ठ नागरिकों को निःशुल्क खाद्यान्न।',
                'content' => '<p>Annapurna Yojana in Maharashtra provides free food grains to eligible senior citizens who are not covered under the National Food Security Act (NFSA) / Priority Household ration system, so that no elderly person goes without food.</p>
<h3>Key Features</h3>
<ul>
<li>Free food grain entitlement to senior citizens left out of NFSA</li>
<li>Implemented through the state Food & Civil Supplies / Social Justice machinery</li>
<li>Converges with other old-age welfare measures</li>
</ul>
<h3>Objective</h3>
<p>To ensure food security for destitute and uncovered senior citizens in the state.</p>',
                'eligibility' => 'Senior citizens (generally aged 65 years and above) of Maharashtra who are not covered under NFSA / Priority Household ration cards and who meet the income and residency criteria notified by the department.',
                'benefits' => 'Free monthly food grain entitlement (quantity as per official notification) for eligible senior citizens not covered under NFSA.',
                'application_process' => '1. Approach the local rationing / supply office or Talathi / Gram Panchayat
2. Submit age and non-NFSA coverage proof
3. Verification by the department
4. Name included in the Annapurna beneficiary list
5. Collect free food grains from the designated Fair Price Shop',
                'required_documents' => 'Aadhaar Card, age proof, residence proof, non-NFSA / ration card status, bank account details.',
                'official_website' => 'https://mahadbt.maharashtra.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Annapurna Yojana Maharashtra - Free Food Grains for Seniors',
                'meta_description' => 'Maharashtra Annapurna Yojana gives free food grains to senior citizens not covered under NFSA. Check eligibility and apply.',
            ],

            // SOURCE: https://mahadbt.maharashtra.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Shiv Bhojan Thali',
                'category_id' => $cats['social-welfare'] ?? null,
                'state_id' => 15,
                'short_description' => 'State-subsidised nutritious meal (Thali) available to poor and needy citizens at a nominal price of Rs. 10.',
                'title_hi' => 'शिव भोजन थाली',
                'short_description_hi' => 'गरीब व जरूरतमंद नागरिकों के लिए मात्र ₹10 में पौष्टिक भोजन (थाली)।',
                'content' => '<p>Shiv Bhojan Thali is a Maharashtra government initiative to provide a hot, nutritious, subsidised meal to citizens from economically weaker sections at a nominal price. The scheme is operated through empanelled canteens / centres across the state.</p>
<h3>Key Features</h3>
<ul>
<li>Nutritious Thali at a highly subsidised rate (Rs. 10 nominal charge)</li>
<li>Available through designated Shiv Bhojan centres in urban and rural areas</li>
<li>Aims to make at least one balanced meal affordable for the poor</li>
</ul>
<h3>Objective</h3>
<p>To fight hunger and malnutrition by guaranteeing an affordable cooked meal to every needy citizen.</p>',
                'eligibility' => 'Any citizen from an economically weaker / poor section in Maharashtra can avail the subsidised Thali at a designated Shiv Bhojan centre; no strict income bar is applied at the point of service.',
                'benefits' => 'A hot, nutritious meal (Thali) at a nominal price of Rs. 10, subsidised by the state government.',
                'application_process' => '1. Visit the nearest designated Shiv Bhojan centre
2. Pay the nominal Rs. 10 charge
3. Collect the subsidised Thali
4. Centres are listed / operated by the department as notified',
                'required_documents' => 'Generally none required at the point of service; Aadhaar may be recorded for beneficiary tracking at some centres.',
                'official_website' => 'https://mahadbt.maharashtra.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Shiv Bhojan Thali Maharashtra - Nutritious Meal at Rs. 10',
                'meta_description' => 'Maharashtra Shiv Bhojan Thali provides a nutritious meal at just Rs. 10 for the poor. Find centres and eligibility.',
            ],

            // SOURCE: https://mahadbt.maharashtra.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Mahatma Phule Karj Mafi (Farm Loan Waiver)',
                'category_id' => $cats['agriculture'] ?? null,
                'state_id' => 15,
                'short_description' => 'Maharashtra state loan waiver scheme providing relief to eligible marginal and small farmers by waiving qualifying agricultural loans.',
                'title_hi' => 'महात्मा फुले कर्ज माफी योजना (कृषि ऋण माफी)',
                'short_description_hi' => 'पात्र सीमांत व लघु किसानों को पात्र कृषि ऋण माफ कर महाराष्ट्र सरकार की राहत योजना। लाभ: आधिकारिक पोर्टलानुसार।',
                'content' => '<p>Mahatma Phule Karj Mafi Yojana is the Maharashtra government farm-loan waiver scheme intended to relieve distress among small and marginal farmers by waiving eligible outstanding agricultural loans.</p>
<h3>Key Features</h3>
<ul>
<li>Waiver of eligible short-term agricultural loans for qualifying farmers</li>
<li>Relief delivered through participating banks / cooperative credit institutions</li>
<li>Benefit amount and eligibility capped as per the official notification</li>
</ul>
<h3>Objective</h3>
<p>To reduce the indebtedness of small and marginal farmers and support agricultural revival.</p>',
                'eligibility' => 'Small and marginal farmers of Maharashtra with eligible outstanding agricultural loans, meeting the landholding, loan-type and other criteria specified in the official waiver notification. Exact waiver ceiling is as per official portal.',
                'benefits' => 'Waiver of eligible agricultural loan amount up to the limit notified by the state government (as per official portal).',
                'application_process' => '1. Visit the official portal / nearest cooperative bank or agriculture office
2. Verify farmer and loan records
3. Confirm eligibility against the notified criteria
4. Loan waiver applied to the eligible amount
5. Bank updates the account status after government reconciliation',
                'required_documents' => 'Aadhaar Card, land records (7/12 extract), loan / account details from the lending institution, bank account details, farmer registration proof.',
                'official_website' => 'https://mahadbt.maharashtra.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Mahatma Phule Karj Mafi Yojana Maharashtra - Farm Loan Waiver',
                'meta_description' => 'Maharashtra Mahatma Phule Karj Mafi waives eligible farm loans for small/marginal farmers. Check eligibility and benefit (as per portal).',
            ],

            // SOURCE: https://mahadbt.maharashtra.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Mukhyamantri Gram Sadak Yojana',
                'category_id' => $cats['infrastructure'] ?? null,
                'state_id' => 15,
                'short_description' => 'Rural road connectivity scheme providing all-weather pucca roads to eligible villages and habitations in Maharashtra.',
                'title_hi' => 'मुख्यमंत्री ग्राम सड़क योजना',
                'short_description_hi' => 'महाराष्ट्र के पात्र गाँवों व बस्तियों को ऑल-वेदर पक्की सड़कों से जोड़ने वाली ग्रामीण सड़क योजना।',
                'content' => '<p>Mukhyamantri Gram Sadak Yojana (Chief Minister\'s Rural Road Scheme) is a Maharashtra state programme to provide all-weather pucca road connectivity to rural villages and habitations that lack it.</p>
<h3>Key Features</h3>
<ul>
<li>Construction / upgradation of all-weather pucca roads to eligible habitations</li>
<li>Civic connectivity to markets, schools, health centres and block headquarters</li>
<li>Implemented through the state Rural Development / Public Works machinery</li>
</ul>
<h3>Objective</h3>
<p>To improve last-mile rural connectivity and integrate villages with the economic mainstream.</p>',
                'eligibility' => 'Rural habitations / villages in Maharashtra identified by the department as lacking all-weather road connectivity, prioritised by population and accessibility criteria as per the notified guidelines.',
                'benefits' => 'All-weather pucca road connectivity to the beneficiary village / habitation, built and maintained as per scheme standards.',
                'application_process' => '1. Connectivity gaps are identified by the Gram Panchayat / department survey
2. Eligible habitations are prioritised in the annual works plan
3. Roads are sanctioned and executed by the implementing agency
4. Quality and maintenance monitored by the department',
                'required_documents' => 'Village / habitation details, Gram Panchayat resolution where applicable, existing connectivity status; citizen requests routed through the local body.',
                'official_website' => 'https://mahadbt.maharashtra.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Mukhyamantri Gram Sadak Yojana Maharashtra - Rural Roads',
                'meta_description' => 'Maharashtra Mukhyamantri Gram Sadak Yojana builds all-weather pucca roads to villages. Learn about connectivity and works.',
            ],

            // SOURCE: https://mahadbt.maharashtra.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Mukhyamantri Awas Yojana Maharashtra',
                'category_id' => $cats['housing'] ?? null,
                'state_id' => 15,
                'short_description' => 'Housing scheme of Maharashtra providing pucca houses / financial assistance to eligible rural and urban poor households.',
                'title_hi' => 'मुख्यमंत्री आवास योजना (महाराष्ट्र)',
                'short_description_hi' => 'महाराष्ट्र की आवास योजना जो पात्र ग्रामीण व शहरी गरीब परिवारों को पक्का घर / वित्तीय सहायता देती है।',
                'content' => '<p>Mukhyamantri Awas Yojana Maharashtra is the state housing scheme aimed at providing pucca houses and financial assistance to houseless and homeless-eligible households in rural and urban areas.</p>
<h3>Key Features</h3>
<ul>
<li>Financial assistance / house construction support for eligible poor households</li>
<li>Converges with central housing missions (PMAY) where applicable</li>
<li>Priority to homeless, kutcha-house and vulnerable households</li>
</ul>
<h3>Objective</h3>
<p>To ensure a pucca house with basic amenities for every eligible poor family in the state.</p>',
                'eligibility' => 'Homeless / houseless and kutcha-house households in Maharashtra meeting the rural or urban poverty and residency criteria notified by the Housing / Rural Development department.',
                'benefits' => 'Financial assistance for construction of a pucca house (amount / unit assistance as per official notification), converged with central schemes where applicable.',
                'application_process' => '1. Register demand through the Gram Panchayat (rural) or urban local body (urban)
2. Verification against eligibility / SECC data
3. Beneficiary selected as per priority
4. House constructed / assistance released in instalments
5. Completion and occupancy certification',
                'required_documents' => 'Aadhaar Card, residence proof, income / BPL proof, land / possession documents (if any), bank account details.',
                'official_website' => 'https://mahadbt.maharashtra.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Mukhyamantri Awas Yojana Maharashtra - Housing for Poor',
                'meta_description' => 'Maharashtra Mukhyamantri Awas Yojana provides pucca houses / assistance to rural and urban poor. Check eligibility and apply.',
            ],

            // SOURCE: https://mahadbt.maharashtra.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Majhi Kanya Bhagyashree Yojana',
                'category_id' => $cats['women-child'] ?? null,
                'state_id' => 15,
                'short_description' => 'Maharashtra girl-child welfare and incentive scheme promoting education and checking female foeticide, with benefits for eligible girl children.',
                'title_hi' => 'माझी कन्या भाग्यश्री योजना',
                'short_description_hi' => 'बालिका कल्याण व शिक्षा को बढ़ावा देने व लिंगानुपात सुधारने वाली महाराष्ट्र की बालिका लाभ योजना।',
                'content' => '<p>Majhi Kanya Bhagyashree Yojana is a Maharashtra government scheme for the welfare of the girl child. It provides conditional incentives / benefits to encourage the education and well-being of girl children and to promote the girl-child sex ratio.</p>
<h3>Key Features</h3>
<ul>
<li>Conditional benefit / incentive for eligible girl children in the family</li>
<li>Encourages education and continued schooling of the girl child</li>
<li>Promotes awareness against female foeticide</li>
</ul>
<h3>Objective</h3>
<p>To secure the future of the girl child through financial support linked to education and upbringing.</p>',
                'eligibility' => 'Girl children of Maharashtra families meeting the notified criteria (family size / income and girl-child conditions). Exact benefit amount and conditions are as per the official notification on the state portal.',
                'benefits' => 'Conditional financial benefit / incentive for the eligible girl child, paid as per the official scheme norms (as per official portal).',
                'application_process' => '1. Register the birth of the girl child
2. Apply through the Women & Child Development department / Anganwadi or the official portal
3. Submit required certificates
4. Verification by the department
5. Benefit released as per the scheme stage (birth / schooling milestones)',
                'required_documents' => 'Birth certificate of the girl child, Aadhaar Card, parent identity proof, income / eligibility proof, bank account details.',
                'official_website' => 'https://mahadbt.maharashtra.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => true,
                'meta_title' => 'Majhi Kanya Bhagyashree Yojana Maharashtra - Girl Child Scheme',
                'meta_description' => 'Maharashtra Majhi Kanya Bhagyashree Yojana supports the girl child with education-linked benefits. Check eligibility and apply.',
            ],

            // SOURCE: https://mahadbt.maharashtra.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Maharashtra Employment Guarantee (MGNREGA Maharashtra)',
                'category_id' => $cats['employment'] ?? null,
                'state_id' => 15,
                'short_description' => 'Maharashtra implementation of the Mahatma Gandhi NREGA guaranteeing 100 days of wage employment per year to rural households.',
                'title_hi' => 'महाराष्ट्र रोजगार हमी / MGNREGA (महाराष्ट्र)',
                'short_description_hi' => 'ग्रामीण परिवारों को प्रति वर्ष 100 दिन की वेतन रोजगार की वैधानिक गारंटी देने वाली महाराष्ट्र की MGNREGA योजना। लाभ: 100 दिन।',
                'content' => '<p>The Maharashtra Employment Guarantee scheme is the state implementation of the Mahatma Gandhi National Rural Employment Guarantee Act (MGNREGA), providing a legal guarantee of 100 days of unskilled wage employment per financial year to every rural household whose adult members volunteer for such work.</p>
<h3>Key Features</h3>
<ul>
<li>Legal guarantee of 100 days of wage employment per household per year</li>
<li>Wages paid to the bank / post-office account of the worker</li>
<li>Unemployment allowance if work is not provided within the stipulated period</li>
<li>One-third of the work force reserved for women</li>
</ul>
<h3>Objective</h3>
<p>To enhance livelihood security in rural Maharashtra through guaranteed wage employment and durable asset creation.</p>',
                'eligibility' => 'Any adult member of a rural household in Maharashtra who volunteers for unskilled manual work. Household registers with the Gram Panchayat to obtain a job card.',
                'benefits' => 'Up to 100 days of guaranteed wage employment per household per financial year, with wages paid as per the notified state wage rate.',
                'application_process' => '1. Apply to the Gram Panchayat for a job card
2. Job card issued after verification (within 15 days)
3. Demand work in advance of the required date
4. Work allocated within the stipulated period or unemployment allowance paid
5. Wages credited to the bank / post-office account',
                'required_documents' => 'Aadhaar Card, bank / post-office account details, address proof, passport-size photograph.',
                'official_website' => 'https://mahadbt.maharashtra.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Maharashtra MGNREGA - 100 Days Employment Guarantee',
                'meta_description' => 'Maharashtra MGNREGA guarantees 100 days wage employment to rural households. Check eligibility, get a job card and apply.',
            ],

            // SOURCE: https://mahadbt.maharashtra.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Sanjay Gandhi Niradhar Anudan Yojana',
                'category_id' => $cats['social-welfare'] ?? null,
                'state_id' => 15,
                'short_description' => 'Monthly pension scheme of Maharashtra for destitute, disabled, widows, elderly and transgender persons without any other means of support.',
                'title_hi' => 'संजय गांधी निराधार अनुदान योजना',
                'short_description_hi' => 'महाराष्ट्र की मासिक पेंशन योजना जो सहारा रहित निराधार/विकलांग/विधवा/वृद्ध व ट्रांसजेंडर व्यक्तियों को दी जाती है।',
                'content' => '<p>Sanjay Gandhi Niradhar Anudan Yojana is a Maharashtra social-security scheme providing a monthly pension to destitute persons who have no means of subsistence and are not covered by any other pension scheme.</p>
<h3>Key Features</h3>
<ul>
<li>Monthly pension to destitute, disabled, widows, elderly and transgender persons</li>
<li>Benefit for those without any other source of support</li>
<li>Direct Benefit Transfer to the beneficiary account</li>
</ul>
<h3>Objective</h3>
<p>To provide a basic social-security net to the most vulnerable and unsupported sections of society.</p>',
                'eligibility' => 'Destitute persons of Maharashtra who are disabled, widows, elderly, or transgender and who have no sustainable means of income and are not availing any other state / central pension, subject to the notified age and income criteria.',
                'benefits' => 'Monthly pension amount as per the official notified rate, credited directly to the beneficiary bank account.',
                'application_process' => '1. Approach the local Talathi / Gram Panchayat or municipal office
2. Submit the application with supporting certificates
3. Verification of destitute / disability status by the department
4. Name included in the beneficiary list
5. Monthly pension credited via DBT',
                'required_documents' => 'Aadhaar Card, age proof, disability / widow / transgender certificate as applicable, residence proof, income / destitute proof, bank account details.',
                'official_website' => 'https://mahadbt.maharashtra.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Sanjay Gandhi Niradhar Anudan Yojana Maharashtra - Monthly Pension',
                'meta_description' => 'Maharashtra Sanjay Gandhi Niradhar Anudan gives monthly pension to destitute/disabled/widow/transgender persons. Check eligibility.',
            ],

            // SOURCE: https://mahadbt.maharashtra.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Maharashtra Krushi Input Subsidy',
                'category_id' => $cats['agriculture'] ?? null,
                'state_id' => 15,
                'short_description' => 'Maharashtra agriculture input / equipment subsidy scheme supporting farmers with inputs and farm machinery assistance.',
                'title_hi' => 'महाराष्ट्र कृषी इनपुट सब्सिडी',
                'short_description_hi' => 'महाराष्ट्र की कृषि इनपुट / उपकरण सब्सिडी योजना जो किसानों को इनपुट व कृषि यंत्र सहायता देती है। लाभ: आधिकारिक पोर्टलानुसार।',
                'content' => '<p>Maharashtra Krushi (Agriculture) Input Subsidy is a state support measure providing subsidy / assistance to farmers for agricultural inputs and farm equipment so as to improve productivity and reduce input cost.</p>
<h3>Key Features</h3>
<ul>
<li>Subsidy on eligible agricultural inputs and farm machinery / equipment</li>
<li>Support to small and marginal farmers as per notified priority</li>
<li>Disbursed through the Agriculture / cooperative department network</li>
</ul>
<h3>Objective</h3>
<p>To lower the cost of cultivation and promote modern, productive farming practices among Maharashtra farmers.</p>',
                'eligibility' => 'Farmers of Maharashtra, generally small and marginal, meeting the landholding and activity criteria notified for the specific input / equipment subsidy component. Exact subsidy rates are as per the official portal.',
                'benefits' => 'Subsidy / financial assistance on notified agricultural inputs and farm equipment, as per the official scheme rates (as per official portal).',
                'application_process' => '1. Visit the official portal / nearest agriculture or cooperative office
2. Select the applicable input / equipment subsidy component
3. Submit land and farmer details with quotations
4. Verification by the department
5. Subsidy released / claim settled as per norms',
                'required_documents' => 'Aadhaar Card, land records (7/12 extract), farmer registration, equipment quotation / purchase proof, bank account details.',
                'official_website' => 'https://mahadbt.maharashtra.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Maharashtra Krushi Input Subsidy - Farm Input & Equipment Aid',
                'meta_description' => 'Maharashtra Krushi Input Subsidy supports farmers with input and equipment subsidy. Check eligibility and apply (rates as per portal).',
            ],

            // SOURCE: https://mahadbt.maharashtra.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Vidyarthi Mitra (Earn While Learn)',
                'category_id' => $cats['education'] ?? null,
                'state_id' => 15,
                'short_description' => 'Maharashtra scheme offering part-time work opportunities to students so they can earn a stipend while continuing their studies.',
                'title_hi' => 'विद्यार्थी मित्र / कमाओ और सीखो',
                'short_description_hi' => 'महाराष्ट्र की योजना जो विद्यार्थियों को अंशकालिक कार्य का अवसर देती है ताकि वे पढ़ाई के साथ-साथ वजीफा कमा सकें। लाभ: वजीफा।',
                'content' => '<p>Vidyarthi Mitra (Earn While Learn) is a Maharashtra initiative that provides part-time work opportunities to students, enabling them to earn a stipend and gain experience while pursuing their education.</p>
<h3>Key Features</h3>
<ul>
<li>Part-time work assignments for enrolled students</li>
<li>Stipend / honorarium for the work performed</li>
<li>Helps students meet education-related expenses</li>
</ul>
<h3>Objective</h3>
<p>To support students financially and build work experience through structured part-time engagement.</p>',
                'eligibility' => 'Students enrolled in recognised educational institutions in Maharashtra, meeting the course / attendance and other criteria notified for the scheme. Stipend and work details are as per the official portal.',
                'benefits' => 'A stipend / honorarium for part-time work performed under the scheme, supporting the student\'s educational expenses (as per official portal).',
                'application_process' => '1. Register on the official portal / through the educational institution
2. Select available part-time work assignments
3. Complete the assigned work / training
4. Submit attendance / work proof
5. Stipend credited to the student bank account',
                'required_documents' => 'Aadhaar Card, student ID / enrolment proof, bank account details, institution verification.',
                'official_website' => 'https://mahadbt.maharashtra.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Vidyarthi Mitra (Earn While Learn) Maharashtra - Student Stipend',
                'meta_description' => 'Maharashtra Vidyarthi Mitra (Earn While Learn) gives students part-time work and a stipend. Check eligibility and apply.',
            ],
        ];

        foreach ($schemes as $scheme) {
            // Build a unique slug: Str::slug(title), append '-maharashtra' on collision.
            $baseSlug = Str::slug($scheme['title']);
            $slug = $baseSlug;
            $suffix = 1;
            while (Scheme::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-maharashtra' . ($suffix > 1 ? '-' . $suffix : '');
                $suffix++;
            }
            $scheme['slug'] = $slug;

            Scheme::updateOrCreate(
                ['slug' => $scheme['slug']],
                $scheme
            );
        }

        $this->command->info('StateSchemesMaharashtraSeeder: inserted/updated ' . count($schemes) . ' Maharashtra schemes (state_id=15).');
    }
}
