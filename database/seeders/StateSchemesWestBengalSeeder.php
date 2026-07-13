<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Scheme;
use App\Models\State;
use Illuminate\Database\Seeder;

class StateSchemesWestBengalSeeder extends Seeder
{
    public function run(): void
    {
        // West Bengal state (slug 'west-bengal', id = 29)
        $state = State::where('slug', 'west-bengal')->first();

        if (! $state) {
            $this->command->error('West Bengal state not found. Run StateSeeder first.');
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

            // SOURCE: https://www.wb.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Kanyashree Prakalpa',
                'slug' => 'kanyashree-prakalpa-wb',
                'category_id' => $cats['women-child'] ?? null,
                'state_id' => 29,
                'short_description' => 'Conditional cash transfer scheme to keep girls in school and prevent child marriage. Provides annual scholarship and a one-time grant at age 18.',
                'title_hi' => 'कन्याश्री प्रकल्प',
                'short_description_hi' => 'बालिकाओं को विद्यालय में बनाए रखने व बाल विवाह रोकने हेतु प्रतिबंधित नकद अंतरण योजना। वार्षिक छात्रवृत्ति व 18 वर्ष पर एकमुश्त अनुदान।',
                'content' => '<p>Kanyashree Prakalpa is a flagship conditional cash transfer scheme of the Government of West Bengal aimed at improving the status and well-being of girls, specifically those from disadvantaged families, by incentivising schooling and delaying marriage.</p>
<h3>Key Features</h3>
<ul>
<li>Annual scholarship of ₹1,000 per year to eligible girl students (K1 component)</li>
<li>One-time grant of ₹25,000 at age 18 for unmarried girls (K2 component)</li>
<li>Targets girls aged 13–18 years enrolled in class VIII or above</li>
<li>Direct Benefit Transfer (DBT) to bank / post office account</li>
</ul>
<h3>Objective</h3>
<p>To reduce school drop-out among girls and prevent child marriage by providing financial support conditional on education and unmarried status.</p>',
                'eligibility' => 'Unmarried girl students of West Bengal aged 13–18 years studying in class VIII or above; girls with special needs up to 19 years. Family income ceiling and other conditions are as per the official portal.',
                'benefits' => '₹1,000 per year (annual scholarship) and a one-time ₹25,000 grant at age 18 for eligible unmarried girls, transferred directly to the beneficiary account.',
                'application_process' => '1. Collect the Kanyashree application form from school / college or the official portal
2. Fill in personal, bank and family details
3. Submit the form with the required documents to the school / institution
4. School verifies and forwards to the Block / Municipality
5. District-level sanction and DBT credit to the beneficiary account',
                'required_documents' => 'Aadhaar Card, age / birth proof, school enrolment / attendance proof, bank or post office account details, income certificate (where applicable), passport-size photograph.',
                'official_website' => 'https://www.wb.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => true,
                'meta_title' => 'Kanyashree Prakalpa West Bengal - Girl Child Cash Transfer Scheme',
                'meta_description' => 'Kanyashree Prakalpa gives ₹1,000/yr plus ₹25,000 at 18 to keep girls in school and prevent child marriage in West Bengal. Check eligibility and apply.',
            ],

            // SOURCE: https://www.wb.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Swasthya Sathi',
                'slug' => 'swasthya-sathi-wb',
                'category_id' => $cats['health'] ?? null,
                'state_id' => 29,
                'short_description' => 'Cashless, paperless health insurance scheme for all families of West Bengal. Provides coverage of up to ₹5 lakh per family per year.',
                'title_hi' => 'स्वास्थ्य साथी',
                'short_description_hi' => 'पश्चिम बंगाल के सभी परिवारों हेतु नकद-रहित, कागज़-रहित स्वास्थ्य बीमा योजना। प्रति परिवार प्रति वर्ष 5 लाख रुपये तक का कवर।',
                'content' => '<p>Swasthya Sathi is a flagship health insurance scheme of the Government of West Bengal providing cashless and paperless treatment to the citizens of the state. Each enrolled family receives a smart card.</p>
<h3>Key Features</h3>
<ul>
<li>Coverage of up to ₹5 lakh per family per year</li>
<li>Cashless and paperless treatment at empanelled government and private hospitals</li>
<li>No cap on family size, age or number of members</li>
<li>Smart card issued to each family for portability across the state</li>
</ul>
<h3>Objective</h3>
<p>To provide universal health coverage and protect families from catastrophic medical expenditure through a state-sponsored health insurance scheme.</p>',
                'eligibility' => 'All resident families of West Bengal are covered under the scheme. Beneficiaries are enrolled primarily through the Duare Sarkar camps and existing databases. Specific exclusions are as per the official notification.',
                'benefits' => 'Health insurance cover of up to ₹5 lakh per family per year with cashless treatment at empanelled hospitals, including pre- and post-hospitalisation expenses.',
                'application_process' => '1. Families are enrolled through Duare Sarkar camps / Gram Panchayat / Municipality
2. Swasthya Sathi smart card is issued to the family
3. Visit any empanelled hospital and present the smart card
4. Treatment is cashless; the hospital raises the claim
5. Details and card status on the official Swasthya Sathi portal',
                'required_documents' => 'Aadhaar Card / Voter ID, family ration card or residence proof, photograph, bank account details (where required) for enrolment and card issuance.',
                'official_website' => 'https://www.wb.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => true,
                'meta_title' => 'Swasthya Sathi West Bengal - Cashless Health Insurance up to ₹5 Lakh',
                'meta_description' => 'Swasthya Sathi gives cashless health cover up to ₹5 lakh per family in West Bengal. Check eligibility, empanelled hospitals and apply.',
            ],

            // SOURCE: https://www.wb.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Khadya Sathi',
                'slug' => 'khadya-sathi-wb',
                'category_id' => $cats['social-welfare'] ?? null,
                'state_id' => 29,
                'short_description' => 'Food security scheme of West Bengal providing rice and wheat at ₹2 per kg to ration card holders under the National Food Security framework.',
                'title_hi' => 'खाद्य साथी',
                'short_description_hi' => 'पश्चिम बंगाल की खाद्य सुरक्षा योजना जो राशन कार्ड धारकों को 2 रुपये प्रति किलो चावल व गेहूँ देती है।',
                'content' => '<p>Khadya Sathi is the food security programme of the Government of West Bengal aimed at ensuring that no one in the state goes to bed hungry. It provides subsidised food grains to ration card holders.</p>
<h3>Key Features</h3>
<ul>
<li>Rice / wheat at ₹2 per kg to eligible ration card holders</li>
<li>Coverage of the majority of the state population under NFSA and state top-up</li>
<li>Distribution through Fair Price Shops (FPS)</li>
<li>Convergence with Aadhaar for beneficiary authentication</li>
</ul>
<h3>Objective</h3>
<p>To achieve near-universal food security in West Bengal by providing affordable food grains to every eligible household.</p>',
                'eligibility' => 'Ration card holders of West Bengal — priority and non-priority households under the National Food Security Act and state-specific categories as notified.',
                'benefits' => 'Subsidised food grains (rice / wheat) at ₹2 per kg per eligible beneficiary, distributed through Fair Price Shops.',
                'application_process' => '1. Apply for a ration card at the nearest Food & Supplies office / Duare Sarkar camp
2. Submit residence, identity and family details
3. Verification and issuance of ration card
4. Collect food grains from the allotted Fair Price Shop using the ration card / Aadhaar',
                'required_documents' => 'Aadhaar Card, residence proof, family member details, photograph, and other documents as prescribed for ration card issuance.',
                'official_website' => 'https://www.wb.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => true,
                'meta_title' => 'Khadya Sathi West Bengal - Rice & Wheat at ₹2/kg',
                'meta_description' => 'Khadya Sathi provides rice and wheat at ₹2 per kg to ration card holders in West Bengal. Check eligibility and apply for a ration card.',
            ],

            // SOURCE: https://www.wb.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Duare Sarkar',
                'slug' => 'duare-sarkar-wb',
                'category_id' => $cats['digital-india'] ?? null,
                'state_id' => 29,
                'short_description' => 'Doorstep government services campaign of West Bengal bringing schemes and certificates to citizens through local camps.',
                'title_hi' => 'द्वारे सरकार',
                'short_description_hi' => 'पश्चिम बंगाल का द्वार-पर-सरकारी-सेवा अभियान जो स्थानीय शिविरों के माध्यम से योजनाएं व प्रमाणपत्र नागरिकों तक पहुँचाता है।',
                'content' => '<p>Duare Sarkar (Government at the Doorstep) is a citizen outreach campaign of the Government of West Bengal that sets up camps at the gram panchayat / municipal ward level to deliver government services and scheme benefits directly to citizens.</p>
<h3>Key Features</h3>
<ul>
<li>On-the-spot enrolment and application for multiple state schemes</li>
<li>Issuance / correction of caste, income, domicile and other certificates</li>
<li>Enrolment under Swasthya Sathi, Khadya Sathi and social security pensions</li>
<li>Camp-based service with department officials present at the venue</li>
</ul>
<h3>Objective</h3>
<p>To take government services to the doorstep of citizens and improve last-mile delivery and awareness of welfare schemes.</p>',
                'eligibility' => 'All residents of West Bengal can avail services at Duare Sarkar camps as per the specific scheme criteria for each service offered.',
                'benefits' => 'Convenient doorstep access to government schemes and certificates — health card enrolment, ration card services, pensions, caste / income / domicile certificates and more.',
                'application_process' => '1. Visit the nearest Duare Sarkar camp in your Gram Panchayat / Municipality
2. Identify the service / scheme you need
3. Submit the application and documents at the camp
4. Department officials verify on the spot / subsequently
5. Service delivered or certificate / benefit issued as notified',
                'required_documents' => 'Aadhaar Card, residence proof, relevant scheme-specific documents (income / caste / age proof, bank details) as applicable to the service sought.',
                'official_website' => 'https://www.wb.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Duare Sarkar West Bengal - Doorstep Government Services',
                'meta_description' => 'Duare Sarkar brings West Bengal government schemes and certificates to your doorstep via local camps. Find services and eligibility.',
            ],

            // SOURCE: https://www.wb.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Sabooj Sathi',
                'slug' => 'sabooj-sathi-wb',
                'category_id' => $cats['education'] ?? null,
                'state_id' => 29,
                'short_description' => 'Scheme providing free bicycles to students of West Bengal to improve school attendance and reduce dropout by easing commutes.',
                'title_hi' => 'सबुज साथी',
                'short_description_hi' => 'पश्चिम बंगाल के विद्यार्थियों को निःशुल्क साइकिल देने वाली योजना जिससे विद्यालय उपस्थिति व संचार सुगम हो।',
                'content' => '<p>Sabooj Sathi is a West Bengal government scheme that distributes free bicycles to students to help them commute to school, thereby improving attendance and reducing dropout rates, especially in rural areas.</p>
<h3>Key Features</h3>
<ul>
<li>Free bicycle to eligible students of class IX and above (as notified)</li>
<li>Aims to improve access to schools located at a distance</li>
<li>Distribution through schools under the Education Department</li>
</ul>
<h3>Objective</h3>
<p>To promote continuation of education by removing the transport barrier for students, particularly girls and those in remote areas.</p>',
                'eligibility' => 'Students of government / government-aided schools in West Bengal, generally of class IX and above, meeting the criteria notified by the School Education Department.',
                'benefits' => 'A free bicycle to the eligible student to commute to school, improving access and reducing dropout.',
                'application_process' => '1. Student enrolled in an eligible school is identified by the institution
2. School prepares the list of eligible students
3. Bicycle distributed through the school / institution
4. Details recorded by the Education Department',
                'required_documents' => 'School enrolment proof, student identity particulars, Aadhaar (where required), bank / account details as applicable.',
                'official_website' => 'https://www.wb.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Sabooj Sathi West Bengal - Free Bicycle for Students',
                'meta_description' => 'Sabooj Sathi provides free bicycles to West Bengal students to improve school attendance. Check eligibility and distribution.',
            ],

            // SOURCE: https://www.wb.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Yuvashree',
                'slug' => 'yuvashree-wb',
                'category_id' => $cats['employment'] ?? null,
                'state_id' => 29,
                'short_description' => 'Unemployment allowance scheme of West Bengal providing a monthly stipend to educated unemployed youth registered with the employment bank.',
 'title_hi' => 'युवाश्री',
                'short_description_hi' => 'पश्चिम बंगाल की बेरोजगारी भत्ता योजना जो पंजीकृत शिक्षित बेरोजगार युवाओं को मासिक सहायता देती है।',
                'content' => '<p>Yuvashree is a West Bengal government scheme providing a monthly unemployment allowance to educated unemployed youth who are registered with the state employment bank, to support them while they seek suitable employment.</p>
<h3>Key Features</h3>
<ul>
<li>Monthly allowance of ₹1,500 to eligible unemployed youth</li>
<li>For educated youth registered with the West Bengal employment bank</li>
<li>Direct Benefit Transfer to the beneficiary bank account</li>
</ul>
<h3>Objective</h3>
<p>To provide financial support to educated unemployed youth and encourage them to register, train and seek employment.</p>',
                'eligibility' => 'Educated unemployed youth of West Bengal registered with the state employment bank, meeting the educational qualification and age criteria notified on the official portal.',
                'benefits' => 'Monthly unemployment allowance of ₹1,500 transferred directly to the beneficiary bank account for the notified period.',
                'application_process' => '1. Register with the West Bengal employment bank (online / employment exchange)
2. Enrol under the Yuvashree scheme
3. Complete verification of educational and unemployment status
4. Monthly allowance credited after approval',
                'required_documents' => 'Aadhaar Card, educational certificates, employment bank registration details, bank account details, residence proof.',
                'official_website' => 'https://www.wb.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Yuvashree West Bengal - ₹1,500/month Unemployment Allowance',
                'meta_description' => 'Yuvashree gives ₹1,500 per month to educated unemployed youth in West Bengal. Check eligibility and register with the employment bank.',
            ],

            // SOURCE: https://www.wb.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Krishak Bandhu',
                'slug' => 'krishak-bandhu-wb',
                'category_id' => $cats['agriculture'] ?? null,
                'state_id' => 29,
                'short_description' => 'Agricultural scheme of West Bengal providing financial assistance and crop insurance support to farmers (as per official portal).',
                'title_hi' => 'कृषक बंधु',
                'short_description_hi' => 'पश्चिम बंगाल की कृषि योजना जो किसानों को वित्तीय सहायता व फसल बीमा समर्थन देती है (आधिकारिक पोर्टलानुसार)।',
                'content' => '<p>Krishak Bandhu is a West Bengal government scheme for the welfare of farmers, providing financial assistance and insurance support linked to agricultural activity. It aims to support farmers and their families against crop loss and distress.</p>
<h3>Key Features</h3>
<ul>
<li>Financial assistance to farmers for agricultural activity</li>
<li>Insurance / death-benefit component for registered farmers</li>
<li>Assistance linked to cultivated land as per notified norms</li>
</ul>
<p>Exact benefit amounts and eligibility criteria are as per the official notification on the state portal.</p>',
                'eligibility' => 'Farmers of West Bengal owning / cultivating land and registered under the scheme, meeting the criteria notified by the Agriculture / Horticulture Department on the official portal.',
                'benefits' => 'Financial assistance and insurance support to farmers as per official rates published on the portal.',
                'application_process' => '1. Register as a farmer under Krishak Bandhu at the Block Agriculture Office / Duare Sarkar camp
2. Submit land and bank details
3. Verification by the department
4. Assistance / insurance benefit released as per norms',
                'required_documents' => 'Aadhaar Card, land records (Khatian / plot details), bank account details, farmer registration particulars, residence proof.',
                'official_website' => 'https://www.wb.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Krishak Bandhu West Bengal - Farmer Financial Aid & Insurance',
                'meta_description' => 'Krishak Bandhu provides financial aid and insurance to West Bengal farmers. Check eligibility and register with the Agriculture Department.',
            ],

            // SOURCE: https://www.wb.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Banglar Bari',
                'slug' => 'banglar-bari-wb',
                'category_id' => $cats['housing'] ?? null,
                'state_id' => 29,
                'short_description' => 'Housing scheme of West Bengal providing pucca houses to homeless and landless families (as per official portal).',
                'title_hi' => 'बांग्लार बाड़ी',
                'short_description_hi' => 'पश्चिम बंगाल की आवास योजना जो बेघर व भूमिहीन परिवारों को पक्का मकान देती है (आधिकारिक पोर्टलानुसार)।',
                'content' => '<p>Banglar Bari is a West Bengal government housing scheme to provide pucca houses to homeless and landless families who do not own a dwelling, improving shelter security for the most vulnerable.</p>
<h3>Key Features</h3>
<ul>
<li>Pucca house / homestead to eligible homeless / landless families</li>
<li>Priority to families without any permanent dwelling</li>
<li>Convergence with other rural housing initiatives where applicable</li>
</ul>
<p>Exact assistance amount and eligibility are as per the official notification.</p>',
                'eligibility' => 'Homeless and landless families of West Bengal without a permanent dwelling, meeting the criteria prescribed by the concerned department on the official portal.',
                'benefits' => 'A pucca house / homestead plot and financial assistance to eligible homeless and landless families, as per official norms.',
                'application_process' => '1. Apply at the Gram Panchayat / Municipality or Duare Sarkar camp
2. Submit residence and family details
3. Verification and selection as per priority
4. House / plot allotted and assistance released',
                'required_documents' => 'Aadhaar Card, residence proof, income / deprivation proof, bank account details, family particulars.',
                'official_website' => 'https://www.wb.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Banglar Bari West Bengal - Housing for Homeless Families',
                'meta_description' => 'Banglar Bari provides pucca houses to homeless / landless families in West Bengal. Check eligibility and apply.',
            ],

            // SOURCE: https://www.wb.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Rupashree Prakalpa',
                'slug' => 'rupashree-prakalpa-wb',
                'category_id' => $cats['women-child'] ?? null,
                'state_id' => 29,
                'short_description' => 'Marriage grant scheme of West Bengal providing a one-time financial assistance of ₹25,000 to poor families for the marriage of their daughter.',
                'title_hi' => 'रूपश्री प्रकल्प',
                'short_description_hi' => 'पश्चिम बंगाल की विवाह अनुदान योजना जो गरीब परिवारों की बेटी के विवाह हेतु 25,000 रुपये एकमुश्त देती है।',
                'content' => '<p>Rupashree Prakalpa is a West Bengal government scheme providing a one-time marriage grant to eligible poor families for the marriage of their daughters, to reduce the financial burden of marriage.</p>
<h3>Key Features</h3>
<ul>
<li>One-time financial assistance of ₹25,000 per eligible girl at the time of marriage</li>
<li>Targeted at girls from economically weaker families</li>
<li>Direct Benefit Transfer to the beneficiary bank account</li>
</ul>
<h3>Objective</h3>
<p>To provide financial support to poor families for the marriage of their daughters and discourage child marriage.</p>',
                'eligibility' => 'Daughters of West Bengal families meeting the income and age criteria (generally 18 years and above at marriage) notified by the Women & Child Development / Social Welfare Department.',
                'benefits' => 'A one-time grant of ₹25,000 to the eligible family at the time of the daughter’s marriage, credited directly to the bank account.',
                'application_process' => '1. Obtain the Rupashree application form from the Block / Municipality / Duare Sarkar camp
2. Submit the application with marriage and income details
3. Verification by the department
4. Grant released as a one-time DBT at marriage',
                'required_documents' => 'Daughter age / birth proof, family income certificate, marriage-related documents, Aadhaar Card, bank account details.',
                'official_website' => 'https://www.wb.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Rupashree Prakalpa West Bengal - ₹25,000 Marriage Grant',
                'meta_description' => 'Rupashree Prakalpa gives a ₹25,000 marriage grant to poor families in West Bengal. Check eligibility and apply.',
            ],

            // SOURCE: https://www.wb.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'West Bengal Student Credit Card',
                'slug' => 'wb-student-credit-card-wb',
                'category_id' => $cats['education'] ?? null,
                'state_id' => 29,
                'short_description' => 'Education loan scheme of West Bengal providing credit of up to ₹10 lakh to students for higher / professional studies, with flexible repayment.',
                'title_hi' => 'पश्चिम बंगाल स्टूडेंट क्रेडिट कार्ड',
                'short_description_hi' => 'पश्चिम बंगाल की शैक्षणिक ऋण योजना जो उच्च / व्यावसायिक शिक्षा हेतु विद्यार्थियों को 10 लाख रुपये तक का ऋण लचीली चुकताई पर देती है।',
                'content' => '<p>The West Bengal Student Credit Card (WBSCC) scheme provides education loans of up to ₹10 lakh to students of the state for pursuing higher and professional education, with repayment beginning after course completion.</p>
<h3>Key Features</h3>
<ul>
<li>Education loan of up to ₹10 lakh</li>
<li>Covers tuition, course and related educational expenses</li>
<li>Moratorium during the study period and flexible repayment tenure</li>
<li>Interest subvention / relaxations as per scheme norms</li>
</ul>
<h3>Objective</h3>
<p>To remove the financial barrier to higher education for students of West Bengal and raise the state’s gross enrolment ratio.</p>',
                'eligibility' => 'Resident students of West Bengal admitted to recognised higher / professional courses, meeting the academic and age criteria notified on the official portal. Parent / guardian as co-applicant generally required.',
                'benefits' => 'Education loan of up to ₹10 lakh with study-period moratorium and flexible repayment, covering higher / professional education costs.',
                'application_process' => '1. Apply online through the West Bengal student credit card portal / Duare Sarkar
2. Fill in academic, admission and family details
3. Upload the required documents
4. Verification and sanction by the lending bank
5. Loan disbursed as per the course fee schedule',
                'required_documents' => 'Aadhaar Card, admission proof in recognised institution, 10+2 / mark sheets, course fee details, parent / guardian income proof, bank account details.',
                'official_website' => 'https://www.wb.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'West Bengal Student Credit Card - Education Loan up to ₹10 Lakh',
                'meta_description' => 'WB Student Credit Card offers up to ₹10 lakh education loan for higher studies. Check eligibility, apply online and documents.',
            ],

            // SOURCE: https://www.wb.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Gatidhara',
                'slug' => 'gatidhara-wb',
                'category_id' => $cats['employment'] ?? null,
                'state_id' => 29,
                'short_description' => 'Self-employment scheme of West Bengal providing subsidy / soft loan support to unemployed youth for purchasing commercial vehicles (as per official portal).',
                'title_hi' => 'गतिधारा',
                'short_description_hi' => 'पश्चिम बंगाल की स्वरोजगार योजना जो बेरोजगार युवाओं को वाणिज्यिक वाहन खरीद हेतु अनुदान / सॉफ्ट ऋण देती है (आधिकारिक पोर्टलानुसार)।',
                'content' => '<p>Gatidhara is a West Bengal government self-employment scheme providing subsidy and credit support to unemployed youth for purchasing commercial / transport vehicles, generating livelihood through transport entrepreneurship.</p>
<h3>Key Features</h3>
<ul>
<li>Subsidy / interest subvention on vehicle purchase loan</li>
<li>Aimed at unemployed youth seeking self-employment in transport</li>
<li>Support linked to purchase of notified commercial vehicles</li>
</ul>
<p>Exact subsidy amount and eligibility are as per the official notification on the state portal.</p>',
                'eligibility' => 'Unemployed youth of West Bengal meeting the age and residence criteria notified by the Transport / Micro & Small Enterprises Department for vehicle-based self-employment.',
                'benefits' => 'Subsidy and credit support for purchasing a commercial vehicle, as per official rates published on the portal.',
                'application_process' => '1. Apply through the Gatidhara portal / concerned department
2. Submit identity, residence and bank details
3. Select the notified vehicle and submit the quotation
4. Verification and sanction of subsidy / loan
5. Vehicle purchased and benefit released',
                'required_documents' => 'Aadhaar Card, residence proof, bank account details, driving licence (as applicable), vehicle quotation, income / unemployment proof.',
                'official_website' => 'https://www.wb.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Gatidhara West Bengal - Vehicle Subsidy for Self-Employment',
                'meta_description' => 'Gatidhara provides vehicle subsidy / loan to unemployed youth in West Bengal for self-employment. Check eligibility and apply.',
            ],

            // SOURCE: https://www.wb.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'West Bengal Old Age / Widow Pension',
                'slug' => 'wb-old-age-widow-pension-wb',
                'category_id' => $cats['social-welfare'] ?? null,
                'state_id' => 29,
                'short_description' => 'Social security pension scheme of West Bengal providing a monthly pension to eligible senior citizens, widows and persons with disabilities (as per official portal).',
                'title_hi' => 'पश्चिम बंगाल वृद्धावस्था / विधवा पेंशन',
                'short_description_hi' => 'पश्चिम बंगाल की सामाजिक सुरक्षा पेंशन योजना जो पात्र वरिष्ठ नागरिकों, विधवाओं व दिव्यांगों को मासिक पेंशन देती है (आधिकारिक पोर्टलानुसार)।',
                'content' => '<p>The West Bengal social security pension covers old age pension, widow pension and disability pension, providing a monthly pension to vulnerable sections so they have a steady income in old age or distress.</p>
<h3>Key Features</h3>
<ul>
<li>Monthly pension to eligible senior citizens, widows and persons with disabilities</li>
<li>Implemented through the Department of Social Welfare</li>
<li>Direct Benefit Transfer to the beneficiary bank account</li>
</ul>
<p>The pension amount and eligibility criteria are as notified by the department on the official portal.</p>',
                'eligibility' => 'Residents of West Bengal meeting the age, widowhood / disability and income criteria prescribed by the Social Welfare Department. Beneficiaries already receiving another central / state pension may be excluded as per norms.',
                'benefits' => 'Monthly social security pension to eligible senior citizens, widows and persons with disabilities, credited directly to the bank account via DBT.',
                'application_process' => '1. Apply at the Gram Panchayat / Municipality or Duare Sarkar camp
2. Submit age / widowhood / disability and residence documents
3. Verification by the department
4. Pension activated and credited monthly',
                'required_documents' => 'Aadhaar Card, age proof (birth certificate / certificate from competent authority), widowhood / disability certificate (as applicable), bank account details, residence proof.',
                'official_website' => 'https://www.wb.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'West Bengal Old Age / Widow Pension - Monthly Social Security',
                'meta_description' => 'West Bengal social security pension provides monthly pension to senior citizens, widows and disabled. Check eligibility and apply.',
            ],

            // SOURCE: https://www.wb.gov.in — VERIFY before live (web research unavailable in agent env)
            [
                'title' => 'Sikshashree',
                'slug' => 'sikshashree-wb',
                'category_id' => $cats['education'] ?? null,
                'state_id' => 29,
                'short_description' => 'Stipend scheme of West Bengal providing a stipend to minority students from class I to VIII (and beyond as notified) to encourage education (as per official portal).',
                'title_hi' => 'शिक्षाश्री',
                'short_description_hi' => 'पश्चिम बंगाल की छात्रवृत्ति योजना जो अल्पसंख्यक विद्यार्थियों को शिक्षा हेतु (कक्षा I-VIII व आगे) वजीफा देती है (आधिकारिक पोर्टलानुसार)।',
                'content' => '<p>Sikshashree is a West Bengal government stipend scheme for students belonging to minority communities, aimed at reducing dropout and encouraging continuation of schooling.</p>
<h3>Key Features</h3>
<ul>
<li>Stipend to eligible minority students (classes I to VIII and as notified)</li>
<li>Encourages retention of minority students in school</li>
<li>Direct Benefit Transfer to the beneficiary / guardian account</li>
</ul>
<p>Exact stipend amount and eligibility are as per the official notification on the state portal.</p>',
                'eligibility' => 'Students of West Bengal belonging to notified minority communities, meeting the class and income criteria prescribed by the Minority Affairs / Education Department on the official portal.',
                'benefits' => 'A stipend to eligible minority students to support their schooling, as per official rates published on the portal.',
                'application_process' => '1. Apply through the school / minority welfare portal or Duare Sarkar camp
2. Submit student, minority and income details
3. Verification by the department / school
4. Stipend released as per norms',
                'required_documents' => 'Aadhaar Card, minority community certificate, school enrolment / mark sheet, income certificate, bank account details.',
                'official_website' => 'https://www.wb.gov.in',
                'application_deadline' => null,
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Sikshashree West Bengal - Stipend for Minority Students',
                'meta_description' => 'Sikshashree provides stipend to minority students in West Bengal. Check eligibility and apply online.',
            ],
        ];

        foreach ($schemes as $scheme) {
            Scheme::updateOrCreate(
                ['slug' => $scheme['slug']],
                $scheme
            );
        }

        $this->command->info('StateSchemesWestBengalSeeder: inserted/updated ' . count($schemes) . ' West Bengal schemes (state_id=29).');
    }
}
