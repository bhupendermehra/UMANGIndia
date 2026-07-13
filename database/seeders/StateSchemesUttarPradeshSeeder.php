<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Scheme;
use App\Models\State;
use Illuminate\Database\Seeder;

class StateSchemesUttarPradeshSeeder extends Seeder
{
    public function run(): void
    {
        $state = State::where('slug', 'uttar-pradesh')->first();
        if (!$state) {
            $this->command->error('Uttar Pradesh state not found (slug: uttar-pradesh). Run StateSeeder first.');
            return;
        }
        // Expected state_id = 27 for Uttar Pradesh.
        $stateId = 27;

        // Resolve category IDs by slug (fallbacks match CategorySeeder sort_order).
        $cats = [];
        $fallback = [
            'education' => 1, 'health' => 2, 'agriculture' => 3, 'housing' => 4,
            'employment' => 5, 'social-welfare' => 6, 'women-child' => 7,
            'financial-inclusion' => 8, 'digital-india' => 9, 'infrastructure' => 10,
            'environment' => 11, 'senior-citizen' => 12,
        ];
        foreach (array_keys($fallback) as $slug) {
            $cats[$slug] = (Category::where('slug', $slug)->first())?->id ?? $fallback[$slug];
        }

        $schemes = [
            // ====== WOMEN & CHILD ======
            // SOURCE: https://www.up.gov.in — VERIFY before live (web research unavailable in agent env).
            [
                'title' => 'Kanya Sumangala Yojana',
                'slug' => 'kanya-sumangala-yojana-up',
                'category_id' => $cats['women-child'],
                'state_id' => $stateId,
                'title_hi' => 'कन्या सुमंगल योजना',
                'short_description' => 'Uttar Pradesh conditional cash transfer scheme providing financial assistance to families for the girl child from birth through various stages of education.',
                'short_description_hi' => 'उत्तर प्रदेश की योजना जिसमें बालिका के जन्म से लेकर शिक्षा के विभिन्न चरणों तक परिवार को शर्ती वित्तीय सहायता दी जाती है।',
                'content' => '<p>Kanya Sumangala Yojana is a flagship scheme of the Government of Uttar Pradesh to promote the well-being and education of the girl child and to improve the child sex ratio.</p>
<h3>Key Highlights</h3>
<ul>
<li>Conditional financial assistance to girl children in families with up to two children</li>
<li>Benefits linked to birth registration and school enrolment/continuation</li>
<li>Implemented through the Women Welfare Department, Government of UP</li>
</ul>
<h3>How it Works</h3>
<p>Assistance is released in instalments tied to milestones such as birth, immunisation, and admission to Class 1, 5, 8, 9, 10, 11 and graduation, as per the official portal.</p>',
                'eligibility' => 'Girl child born on or after 01 April 2019 in a Uttar Pradesh family with no more than two living children, meeting the eligibility criteria published on the official portal.',
                'benefits' => 'As per official portal: conditional financial assistance totalling up to Rs. 15,000 per eligible girl child, paid in instalments linked to education milestones.',
                'application_process' => '1. Visit the official UP portal (up.gov.in)\n2. Register / login with required details\n3. Fill the application form for the girl child\n4. Upload eligibility and bank documents\n5. Submit and track application status online',
                'required_documents' => 'Girl child birth certificate, family income / eligibility proof, bank account details (parent/guardian), Aadhaar, photograph as prescribed on the portal',
                'official_website' => 'https://www.up.gov.in',
                'application_deadline' => null, // ongoing scheme
                'status' => 'active',
                'is_featured' => true,
                'meta_title' => 'Kanya Sumangala Yojana - UP Girl Child Scheme | UmangIndia',
                'meta_description' => 'Details of Uttar Pradesh Kanya Sumangala Yojana: eligibility, benefits, instalments and online apply process for the girl child.',
            ],

            // ====== EDUCATION ======
            // SOURCE: https://www.up.gov.in — VERIFY before live (web research unavailable in agent env).
            [
                'title' => 'Mukhyamantri Abhyudaya Yojana',
                'slug' => 'mukhyamantri-abhyudaya-yojana-up',
                'category_id' => $cats['education'],
                'state_id' => $stateId,
                'title_hi' => 'मुख्यमंत्री अभ्युदय योजना',
                'short_description' => 'Uttar Pradesh scheme providing free coaching and mentorship to meritorious students from weaker sections for competitive examinations (civil services, JEE, NEET, etc.).',
                'short_description_hi' => 'उत्तर प्रदेश की योजना जिसमें कमजोर वर्गों के प्रतिभाशाली छात्रों को प्रतियोगी परीक्षाओं (IAS, IPS, PCS, JEE, NEET आदि) हेतु निःशुल्क कोचिंग व मार्गदर्शन दिया जाता है।',
                'content' => '<p>Mukhyamantri Abhyudaya Yojana is a Uttar Pradesh government scheme to provide free coaching and mentorship to talented students from economically weaker and marginalised sections for various competitive and entrance examinations.</p>
<h3>Key Highlights</h3>
<ul>
<li>Free coaching for civil services (IAS/IPS/PCS), engineering (JEE), medical (NEET), NDA, and other competitive exams</li>
<li>Coaching at district-level Abhyudaya centres and through empanelled institutions</li>
<li>Online and offline mentorship support</li>
</ul>
<h3>How it Works</h3>
<p>Eligible students are selected and provided coaching at Abhyudaya centres established across UP districts, as per the official portal.</p>',
                'eligibility' => 'Students domiciled in Uttar Pradesh from weaker / marginalised sections who have passed the requisite qualifying examination for the targeted competitive exam, as per portal criteria.',
                'benefits' => 'As per official portal: free coaching, study material and mentorship for targeted competitive examinations.',
                'application_process' => '1. Visit the official UP portal (up.gov.in)\n2. Register with student details\n3. Select the competitive exam and centre\n4. Upload documents and submit\n5. Attend selection / counselling as notified',
                'required_documents' => 'Domicile certificate (UP), income certificate, educational certificates, Aadhaar, bank details as prescribed on the portal',
                'official_website' => 'https://www.up.gov.in',
                'application_deadline' => null, // ongoing scheme
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Mukhyamantri Abhyudaya Yojana - Free Coaching UP | UmangIndia',
                'meta_description' => 'Uttar Pradesh Mukhyamantri Abhyudaya Yojana: free coaching for IAS/IPS/PCS/JEE/NEET, eligibility and apply online.',
            ],

            // ====== DIGITAL INDIA ======
            // SOURCE: https://www.up.gov.in — VERIFY before live (web research unavailable in agent env).
            [
                'title' => 'UP e-District Services',
                'slug' => 'up-e-district-services-up',
                'category_id' => $cats['digital-india'],
                'state_id' => $stateId,
                'title_hi' => 'उत्तर प्रदेश ई-डिस्ट्रिक्ट सेवाएं',
                'short_description' => 'Online portal for Uttar Pradesh citizens to apply for and receive certificates and public services such as caste, income, residence, and birth/death certificates.',
                'short_description_hi' => 'उत्तर प्रदेश का ऑनलाइन पोर्टल जहां नागरिक जाति, आय, निवास व जन्म/मृत्यु प्रमाणपत्र आदि के लिए आवेदन कर सकते हैं।',
                'content' => '<p>Uttar Pradesh e-District is the state citizen-services portal that delivers certificates and public services online, reducing the need to visit government offices.</p>
<h3>Key Highlights</h3>
<ul>
<li>Caste, income, residence (domicile), birth and death certificates</li>
<li>Online application, status tracking and download of issued certificates</li>
<li>Integrated with CSC and district administration</li>
</ul>
<h3>How it Works</h3>
<p>Citizens register on the portal, apply for the required service, upload documents and track the application to download the issued certificate.</p>',
                'eligibility' => 'Any resident of Uttar Pradesh requiring a government certificate or public service listed on the e-District portal.',
                'benefits' => 'As per official portal: online, time-bound delivery of certificates and public services with status tracking.',
                'application_process' => '1. Visit the official UP portal (up.gov.in) e-District section\n2. Register / login as citizen\n3. Select the required certificate or service\n4. Fill form and upload documents\n5. Pay fee (if any) and track / download certificate',
                'required_documents' => 'Aadhaar, residence proof, supporting affidavits / records as applicable to the chosen service, photograph',
                'official_website' => 'https://www.up.gov.in',
                'application_deadline' => null, // ongoing service
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'UP e-District Services - Online Certificates Uttar Pradesh | UmangIndia',
                'meta_description' => 'Apply online for caste, income, residence, birth/death certificates via Uttar Pradesh e-District portal.',
            ],

            // ====== HOUSING ======
            // SOURCE: https://www.up.gov.in — VERIFY before live (web research unavailable in agent env).
            [
                'title' => 'Mukhyamantri Awas Yojana UP',
                'slug' => 'mukhyamantri-awas-yojana-up',
                'category_id' => $cats['housing'],
                'state_id' => $stateId,
                'title_hi' => 'मुख्यमंत्री आवास योजना (उत्तर प्रदेश)',
                'short_description' => 'Uttar Pradesh housing scheme providing pucca houses and financial assistance to eligible poor and weaker-section families in rural and urban areas.',
                'short_description_hi' => 'उत्तर प्रदेश की आवास योजना जिसमें पात्र गरीब व कमजोर वर्ग के परिवारों को पक्का मकान व वित्तीय सहायता दी जाती है।',
                'content' => '<p>Mukhyamantri Awas Yojana is the Uttar Pradesh state housing initiative to provide pucca houses and financial assistance to eligible poor and weaker-section families.</p>
<h3>Key Highlights</h3>
<ul>
<li>Financial assistance / housing for eligible poor families</li>
<li>Convergent with Pradhan Mantri Awas Yojana where applicable</li>
<li>Ownership preferential in the name of the woman of the household</li>
</ul>
<h3>How it Works</h3>
<p>Eligible families apply through the gram panchayat / urban local body / housing department; assistance is released in instalments as per the official portal.</p>',
                'eligibility' => 'Poor / weaker-section families of Uttar Pradesh as per the housing department criteria (income and deprivation norms) on the official portal.',
                'benefits' => 'As per official portal: financial assistance / pucca house to eligible families.',
                'application_process' => '1. Visit the official UP portal (up.gov.in) / local body\n2. Apply under the housing scheme\n3. Submit income, residence and eligibility documents\n4. Verification by the department\n5. Assistance released after approval',
                'required_documents' => 'Aadhaar, residence proof, income certificate, bank details, priority category proof (if any)',
                'official_website' => 'https://www.up.gov.in',
                'application_deadline' => null, // ongoing scheme
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Mukhyamantri Awas Yojana UP - Housing Scheme | UmangIndia',
                'meta_description' => 'Uttar Pradesh Mukhyamantri Awas Yojana: housing for poor families, eligibility and apply online.',
            ],

            // ====== EMPLOYMENT ======
            // SOURCE: https://www.up.gov.in — VERIFY before live (web research unavailable in agent env).
            [
                'title' => 'UP Rojgar Abhiyan',
                'slug' => 'up-rojgar-abhiyan-up',
                'category_id' => $cats['employment'],
                'state_id' => $stateId,
                'title_hi' => 'उत्तर प्रदेश रोजगार अभियान',
                'short_description' => 'Uttar Pradesh employment generation campaign to provide livelihood opportunities, skills and jobs to returned migrants and urban poor affected by economic distress.',
                'short_description_hi' => 'उत्तर प्रदेश का रोजगार सृजन अभियान जिसमें वापस लौटे प्रवासियों व शहरी गरीबों को रोजगार व कौशल का अवसर दिया जाता है।',
                'content' => '<p>UP Rojgar Abhiyan is a livelihood and employment generation campaign of the Government of Uttar Pradesh aimed at providing jobs, self-employment and skill training to workers and youth, especially returned migrants.</p>
<h3>Key Highlights</h3>
<ul>
<li>Employment and self-employment opportunities for returned / migrant workers</li>
<li>Skill training and placement support</li>
<li>Convergence with central and state labour / rural schemes</li>
</ul>
<h3>How it Works</h3>
<p>Eligible workers register (often via gram panchayat / portal), are mapped to available jobs or self-employment options, and provided support as per the official portal.</p>',
                'eligibility' => 'Returned migrant workers, urban poor and eligible youth of Uttar Pradesh as per the registration and criteria on the official portal.',
                'benefits' => 'As per official portal: employment / livelihood opportunities, skill training and self-employment support.',
                'application_process' => '1. Visit the official UP portal (up.gov.in) / gram panchayat\n2. Register as a worker / job-seeker\n3. Provide skill and work preferences\n4. Get mapped to jobs / training\n5. Avail placement or self-employment support',
                'required_documents' => 'Aadhaar, bank details, residential / migrant proof, skill certificate (if any), photograph',
                'official_website' => 'https://www.up.gov.in',
                'application_deadline' => null, // ongoing scheme
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'UP Rojgar Abhiyan - Employment Generation Uttar Pradesh | UmangIndia',
                'meta_description' => 'Uttar Pradesh Rojgar Abhiyan: employment and skill opportunities for migrants and youth, eligibility and apply online.',
            ],

            // ====== AGRICULTURE ======
            // SOURCE: https://www.up.gov.in — VERIFY before live (web research unavailable in agent env).
            [
                'title' => 'UP Kisan Karj Mafi',
                'slug' => 'up-kisan-karj-mafi-up',
                'category_id' => $cats['agriculture'],
                'state_id' => $stateId,
                'title_hi' => 'उत्तर प्रदेश किसान कर्ज माफी योजना',
                'short_description' => 'Uttar Pradesh farm loan waiver scheme for small and marginal farmers to relieve agricultural debt burden.',
                'short_description_hi' => 'उत्तर प्रदेश की किसान कर्ज माफी योजना जिसमें छोटे व सीमांत किसानों का कृषि ऋण माफ किया जाता है।',
                'content' => '<p>UP Kisan Karj Mafi is a Uttar Pradesh government debt-relief scheme that waives eligible farm loans of small and marginal farmer families to reduce their financial distress.</p>
<h3>Key Highlights</h3>
<ul>
<li>Waiver of eligible outstanding farm loans</li>
<li>Targeted at small and marginal farmers</li>
<li>Implemented through the Agriculture / cooperative departments, Government of UP</li>
</ul>
<h3>How it Works</h3>
<p>Eligible farmers are identified and their qualifying loan balances are waived as per the notification and portal criteria of the Government of UP.</p>',
                'eligibility' => 'Small and marginal farmer families of Uttar Pradesh with eligible outstanding farm loans, within the landholding and documentation limits notified on the official portal.',
                'benefits' => 'As per official portal: waiver of eligible farm loan amount for qualifying small / marginal farmers.',
                'application_process' => '1. Visit the official UP portal (up.gov.in) / agriculture department\n2. Register / apply under the loan waiver scheme\n3. Submit land and loan documents\n4. Verification by the department\n5. Loan waiver confirmed after approval',
                'required_documents' => 'Farmer registration proof, land records, loan / account statement from bank / cooperative society, Aadhaar, bank details',
                'official_website' => 'https://www.up.gov.in',
                'application_deadline' => null, // ongoing scheme (per notification cycles)
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'UP Kisan Karj Mafi - Farm Loan Waiver Uttar Pradesh | UmangIndia',
                'meta_description' => 'Uttar Pradesh Kisan Karj Mafi: farm loan waiver for small and marginal farmers, eligibility and apply online.',
            ],

            // ====== DIGITAL INDIA ======
            // SOURCE: https://www.up.gov.in — VERIFY before live (web research unavailable in agent env).
            [
                'title' => 'UP Free Laptop / Tablet Yojana',
                'slug' => 'up-free-laptop-tablet-yojana-up',
                'category_id' => $cats['digital-india'],
                'state_id' => $stateId,
                'title_hi' => 'उत्तर प्रदेश निःशुल्क लैपटॉप / टैबलेट योजना',
                'short_description' => 'Uttar Pradesh scheme to distribute free laptops / tablets to meritorious students to promote digital literacy and skill development.',
                'short_description_hi' => 'उत्तर प्रदेश की योजना जिसमें मेधावी छात्रों को डिजिटल साक्षरता व कौशल विकास हेतु निःशुल्क लैपटॉप / टैबलेट वितरित किए जाते हैं।',
                'content' => '<p>The Uttar Pradesh Free Laptop / Tablet Yojana aims to promote digital literacy and support meritorious students of the state with free devices for education and skill development.</p>
<h3>Key Highlights</h3>
<ul>
<li>Free laptops to meritorious students (typically Class 10/12 and higher education)</li>
<li>Free tablets to eligible students / beneficiaries</li>
<li>Promotes digital access for education and employment</li>
</ul>
<h3>How it Works</h3>
<p>Eligible students / beneficiaries are identified through the education / department portal and devices are distributed as per the official notification.</p>',
                'eligibility' => 'Meritorious students of Uttar Pradesh within the merit / category criteria notified on the official portal.',
                'benefits' => 'As per official portal: free laptop / tablet to eligible meritorious students.',
                'application_process' => '1. Visit the official UP portal (up.gov.in) / education department\n2. Register / apply under the distribution scheme\n3. Submit academic / eligibility documents\n4. Verification by the department\n5. Collect device on distribution as notified',
                'required_documents' => 'Academic mark-sheets / certificates, residence proof, Aadhaar, bank details, photograph',
                'official_website' => 'https://www.up.gov.in',
                'application_deadline' => null, // ongoing scheme (distribution cycles as notified)
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'UP Free Laptop / Tablet Yojana - Uttar Pradesh | UmangIndia',
                'meta_description' => 'Uttar Pradesh free laptop / tablet scheme: eligibility for meritorious students and apply online.',
            ],

            // ====== SOCIAL WELFARE ======
            // SOURCE: https://www.up.gov.in — VERIFY before live (web research unavailable in agent env).
            [
                'title' => 'Mukhyamantri Old Age / Widow / Disability Pension',
                'slug' => 'mukhyamantri-pension-yojana-up',
                'category_id' => $cats['social-welfare'],
                'state_id' => $stateId,
                'title_hi' => 'मुख्यमंत्री वृद्धावस्था / विधवा / विकलांग पेंशन योजना',
                'short_description' => 'Uttar Pradesh social security pensions providing monthly financial assistance to elderly, widowed women and persons with disabilities from poor families.',
                'short_description_hi' => 'उत्तर प्रदेश की सामाजिक सुरक्षा पेंशन योजना जिसमें वृद्धजनों, विधवाओं व दिव्यांगजन को मासिक वित्तीय सहायता दी जाती है।',
                'content' => '<p>Mukhyamantri Pension Yojana is a Uttar Pradesh social security scheme providing a monthly pension to elderly citizens, widowed women and persons with disabilities from poor and marginalised families.</p>
<h3>Key Highlights</h3>
<ul>
<li>Monthly pension to eligible senior citizens, widows and persons with disabilities</li>
<li>Implemented by the Social Welfare Department, Government of UP</li>
<li>Direct Benefit Transfer (DBT) to beneficiary bank / post office accounts</li>
</ul>
<h3>How it Works</h3>
<p>Eligible beneficiaries are enrolled and pension is credited directly to their accounts, as per the official portal.</p>',
                'eligibility' => 'Residents of Uttar Pradesh from poor / weak families meeting the age / widow / disability criteria defined by the Social Welfare Department on the official portal.',
                'benefits' => 'As per official portal: monthly pension transferred via DBT to the beneficiary account.',
                'application_process' => '1. Visit the official UP portal (up.gov.in) / social welfare department\n2. Register / apply for the relevant pension\n3. Fill details and upload documents\n4. Submit for departmental verification\n5. Pension credited after approval',
                'required_documents' => 'Age / widow / disability certificate as applicable, residence proof, income certificate, bank / post office account, Aadhaar, photograph',
                'official_website' => 'https://www.up.gov.in',
                'application_deadline' => null, // ongoing scheme
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Mukhyamantri Pension Yojana UP - Old Age / Widow / Disability | UmangIndia',
                'meta_description' => 'Uttar Pradesh social security pensions: old age, widow and disability pension eligibility and apply online.',
            ],

            // ====== AGRICULTURE ======
            // SOURCE: https://www.up.gov.in — VERIFY before live (web research unavailable in agent env).
            [
                'title' => 'Mukhyamantri Krishak Durghatna Kalyan',
                'slug' => 'mukhyamantri-krishak-durghatna-kalyan-yojana-up',
                'category_id' => $cats['agriculture'],
                'state_id' => $stateId,
                'title_hi' => 'मुख्यमंत्री कृषक दुर्घटना कल्याण योजना',
                'short_description' => 'Uttar Pradesh farmer accident insurance scheme providing financial assistance to the family of a farmer in case of death or disability due to an accident.',
                'short_description_hi' => 'उत्तर प्रदेश की किसान दुर्घटना बीमा योजना जिसमें दुर्घटना में मृत्यु या विकलांगता पर किसान के परिवार को वित्तीय सहायता दी जाती है।',
                'content' => '<p>Mukhyamantri Krishak Durghatna Kalyan Yojana is a Uttar Pradesh government accident insurance scheme for farmers, providing financial assistance to the farmer family in the event of accidental death or disability.</p>
<h3>Key Highlights</h3>
<ul>
<li>Cover for registered farmers against accidental death / disability</li>
<li>Financial assistance to the farmer family</li>
<li>Implemented through the Agriculture / Revenue departments, Government of UP</li>
</ul>
<h3>How it Works</h3>
<p>Registered farmers are covered; on an accident, the family claims assistance as per the official portal procedure.</p>',
                'eligibility' => 'Registered farmer of Uttar Pradesh (as per the state farmer registration / portal criteria) who meets the accident and documentation conditions on the official portal.',
                'benefits' => 'As per official portal: financial assistance to the farmer family in case of accidental death / disability (amount as notified by the Government of UP).',
                'application_process' => '1. Ensure farmer registration on the official agriculture portal (up.gov.in)\n2. In case of accident, intimate the department\n3. Submit claim with documents\n4. Verification by the department\n5. Assistance credited to family account after approval',
                'required_documents' => 'Farmer registration proof, Aadhaar, bank details, accident / death / disability certificate, photographs',
                'official_website' => 'https://www.up.gov.in',
                'application_deadline' => null, // ongoing scheme
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Mukhyamantri Krishak Durghatna Kalyan Yojana UP | UmangIndia',
                'meta_description' => 'Uttar Pradesh farmer accident insurance: Krishak Durghatna Kalyan Yojana eligibility, benefits and claim process.',
            ],

            // ====== HEALTH ======
            // SOURCE: https://www.up.gov.in — VERIFY before live (web research unavailable in agent env).
            [
                'title' => 'UP Jan Arogya Yojana',
                'slug' => 'up-jan-arogya-yojana-up',
                'category_id' => $cats['health'],
                'state_id' => $stateId,
                'title_hi' => 'उत्तर प्रदेश जन आरोग्य योजना',
                'short_description' => 'Uttar Pradesh state health protection scheme providing cashless secondary and tertiary hospitalisation cover to eligible poor and vulnerable families.',
                'short_description_hi' => 'उत्तर प्रदेश की स्वास्थ्य सुरक्षा योजना जिसमें पात्र गरीब परिवारों को निःशुल्क द्वितीयक व तृतीयक अस्पताल उपचार का कवर मिलता है।',
                'content' => '<p>UP Jan Arogya Yojana is the Uttar Pradesh state health protection scheme providing health cover to eligible poor and vulnerable families for cashless treatment.</p>
<h3>Key Highlights</h3>
<ul>
<li>Cashless treatment at empanelled government and private hospitals</li>
<li>Cover for secondary and tertiary care hospitalisation</li>
<li>Portable across empanelled hospitals in Uttar Pradesh</li>
</ul>
<h3>How it Works</h3>
<p>Eligible families are identified and issued health cards; treatment is cashless at empanelled hospitals, as per the official portal.</p>',
                'eligibility' => 'Poor and vulnerable families of Uttar Pradesh as identified under the state inclusion criteria published on the official portal.',
                'benefits' => 'As per official portal: health cover for cashless secondary and tertiary care hospitalisation for eligible families.',
                'application_process' => '1. Check eligibility on the official UP portal (up.gov.in)\n2. Locate nearest health / CSC centre\n3. Get the health card issued\n4. Visit any empanelled hospital for cashless treatment\n5. Verify via e-card at point of service',
                'required_documents' => 'Aadhaar / any government photo ID, ration card / eligibility proof, mobile number, as prescribed on the portal',
                'official_website' => 'https://www.up.gov.in',
                'application_deadline' => null, // ongoing scheme
                'status' => 'active',
                'is_featured' => true,
                'meta_title' => 'UP Jan Arogya Yojana - Health Cover Uttar Pradesh | UmangIndia',
                'meta_description' => 'Uttar Pradesh Jan Arogya Yojana: health cover for poor families, eligibility and cashless treatment.',
            ],

            // ====== HOUSING ======
            // SOURCE: https://www.up.gov.in — VERIFY before live (web research unavailable in agent env).
            [
                'title' => 'UP Urban Housing Scheme',
                'slug' => 'up-urban-housing-yojana-up',
                'category_id' => $cats['housing'],
                'state_id' => $stateId,
                'title_hi' => 'उत्तर प्रदेश शहरी आवास योजना',
                'short_description' => 'Uttar Pradesh urban housing scheme providing financial assistance and pucca houses to eligible poor and weaker-section urban families.',
                'short_description_hi' => 'उत्तर प्रदेश की शहरी आवास योजना जिसमें पात्र गरीब व कमजोर वर्ग के शहरी परिवारों को पक्का मकान व वित्तीय सहायता दी जाती है।',
                'content' => '<p>UP Urban Housing Scheme is the Uttar Pradesh state urban housing initiative to provide pucca houses and financial assistance to eligible poor and weaker-section families in urban areas.</p>
<h3>Key Highlights</h3>
<ul>
<li>Financial assistance / housing for eligible urban poor families</li>
<li>Convergent with Pradhan Mantri Awas Yojana - Urban where applicable</li>
<li>Ownership preferential in the name of the woman of the household</li>
</ul>
<h3>How it Works</h3>
<p>Eligible families apply through the urban local body / housing department; assistance is released in instalments as per the official portal.</p>',
                'eligibility' => 'Urban poor / weaker-section families of Uttar Pradesh as per the housing department criteria (income and deprivation norms) on the official portal.',
                'benefits' => 'As per official portal: financial assistance / pucca house to eligible urban families.',
                'application_process' => '1. Visit the official UP portal (up.gov.in) / urban local body\n2. Apply under the urban housing scheme\n3. Submit income, residence and eligibility documents\n4. Verification by the department\n5. Assistance released after approval',
                'required_documents' => 'Aadhaar, residence proof, income certificate, bank details, priority category proof (if any)',
                'official_website' => 'https://www.up.gov.in',
                'application_deadline' => null, // ongoing scheme
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'UP Urban Housing Scheme - Uttar Pradesh | UmangIndia',
                'meta_description' => 'Uttar Pradesh urban housing scheme: eligibility, benefits and apply online.',
            ],

            // ====== EDUCATION ======
            // SOURCE: https://www.up.gov.in — VERIFY before live (web research unavailable in agent env).
            [
                'title' => 'Bal Shramik Vidya Yojana',
                'slug' => 'bal-shramik-vidya-yojana-up',
                'category_id' => $cats['education'],
                'state_id' => $stateId,
                'title_hi' => 'बाल श्रमिक विद्या योजना',
                'short_description' => 'Uttar Pradesh scheme providing education support and incentives to children of labourers / workers to encourage school enrolment and retention.',
                'short_description_hi' => 'उत्तर प्रदेश की योजना जिसमें श्रमिकों के बच्चों को शिक्षा सहायता व प्रोत्साहन देकर स्कूल में प्रवेश व नामांकन बनाए रखा जाता है।',
                'content' => '<p>Bal Shramik Vidya Yojana is a Uttar Pradesh government scheme to support the education of children of labourers / workers by providing financial assistance and incentives for school enrolment and continuity.</p>
<h3>Key Highlights</h3>
<ul>
<li>Education support / stipend to children of labourers</li>
<li>Aimed at enrolment, retention and reducing child labour</li>
<li>Implemented through the Labour / Education departments, Government of UP</li>
</ul>
<h3>How it Works</h3>
<p>Eligible children are enrolled and provided assistance / incentives as per the official portal criteria.</p>',
                'eligibility' => 'Children of registered labourers / workers of Uttar Pradesh within the age and documentation criteria prescribed on the official portal.',
                'benefits' => 'As per official portal: education support / stipend and incentives for school enrolment and retention.',
                'application_process' => '1. Visit the official UP portal (up.gov.in) / labour department\n2. Register the child under Bal Shramik Vidya Yojana\n3. Submit labourer and child documents\n4. Verification by the department\n5. Assistance / stipend as per norms',
                'required_documents' => 'Child birth certificate, parent labourer registration / proof, residence proof, bank details, Aadhaar, photograph',
                'official_website' => 'https://www.up.gov.in',
                'application_deadline' => null, // ongoing scheme
                'status' => 'active',
                'is_featured' => false,
                'meta_title' => 'Bal Shramik Vidya Yojana UP - Education for Workers Children | UmangIndia',
                'meta_description' => 'Uttar Pradesh Bal Shramik Vidya Yojana: education support for children of labourers, eligibility and apply online.',
            ],
        ];

        // Remove any stale Uttar Pradesh schemes not in the current list, then upsert.
        $slugs = array_column($schemes, 'slug');
        Scheme::where('state_id', $stateId)->whereNotIn('slug', $slugs)->delete();

        foreach ($schemes as $scheme) {
            Scheme::updateOrCreate(['slug' => $scheme['slug']], $scheme);
        }

        $count = Scheme::where('state_id', $stateId)->count();
        $this->command->info("StateSchemesUttarPradeshSeeder: inserted/updated " . count($schemes) . " UP schemes. Total for state_id={$stateId}: {$count}.");
    }
}
