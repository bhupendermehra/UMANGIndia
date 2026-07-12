<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Scheme;
use App\Models\State;
use Illuminate\Database\Seeder;

class SchemeSeeder extends Seeder
{
    public function run(): void
    {
        $central = State::where('slug', 'central-government')->first();

        // Get category IDs by slug
        $cats = [];
        foreach (['education', 'health', 'agriculture', 'housing', 'employment', 'social-welfare', 'women-child', 'financial-inclusion', 'digital-india', 'infrastructure', 'environment', 'senior-citizen'] as $slug) {
            $cat = Category::where('slug', $slug)->first();
            if ($cat) $cats[$slug] = $cat->id;
        }

        $schemes = [
            // ====== AGRICULTURE ======
            [
                'title' => 'PM Kisan Samman Nidhi Yojana',
                'slug' => 'pm-kisan-samman-nidhi',
                'category_id' => $cats['agriculture'] ?? 1,
                'state_id' => $central->id,
                'short_description' => 'Direct income support of ₹6,000 per year to small and marginal farmer families in three equal installments of ₹2,000.',
                'content' => '<p>Pradhan Mantri Kisan Samman Nidhi (PM-KISAN) is a central sector scheme launched on 24th February 2019. The scheme aims to provide income support to all landholding farmer families in the country.</p>
<h3>Key Highlights</h3>
<ul>
<li>₹6,000 per year transferred directly to farmer bank accounts</li>
<li>Payment in 3 equal installments of ₹2,000 each</li>
<li>Over 11 crore farmer families benefited</li>
<li>Fund transfer through Direct Benefit Transfer (DBT) mode</li>
</ul>
<h3>How it Works</h3>
<p>The financial year is divided into three instalment periods:</p>
<ul>
<li>1st Installment: April-July</li>
<li>2nd Installment: August-November</li>
<li>3rd Installment: December-March</li>
</ul>',
                'eligibility' => 'All landholding farmer families with cultivable land. The following are NOT eligible: Institutional landholders, former/current constitutional post holders, former/current ministers, serving/retired officers, PSU employees, government employees, taxpayers, professionals with higher income.',
                'benefits' => '₹6,000 per year in 3 installments of ₹2,000 each. Direct bank transfer.',
                'application_process' => '1. Visit pmkisan.gov.in\n2. Click on "Farmers Corner"\n3. Click on "New Farmer Registration"\n4. Enter Aadhaar number and verify OTP\n5. Fill in land details and bank account info\n6. Submit application\n7. Status check via "Beneficiary Status" option',
                'required_documents' => 'Aadhaar Card, Bank Account Details, Land Records (Khata/Khasra number)',
                'official_website' => 'https://pmkisan.gov.in',
                'status' => 'active',
                'is_featured' => true,
                'meta_title' => 'PM Kisan Yojana 2026 - ₹6000/Year to Farmers | UmangIndia',
                'meta_description' => 'Get complete details about PM Kisan Samman Nidhi Yojana. ₹6,000 per year direct income support to farmers. Check eligibility, apply online, track status.',
            ],
            [
                'title' => 'PM Fasal Bima Yojana (PMFBY)',
                'slug' => 'pm-fasal-bima-yojana',
                'category_id' => $cats['agriculture'] ?? 1,
                'state_id' => $central->id,
                'short_description' => 'Crop insurance scheme providing financial support to farmers in case of crop failure due to natural calamities, pests, and diseases.',
                'content' => '<p>Pradhan Mantri Fasal Bima Yojana is a crop insurance scheme launched on 13th January 2016. It replaces the National Agricultural Insurance Scheme (NAIS) and Modified NAIS.</p>
<h3>Coverage</h3>
<ul>
<li>Food crops (Cereals, Millets, Pulses) during Kharif season</li>
<li>Oilseeds, Commercial/Horticultural crops during Rabi season</li>
<li>Annual commercial and horticultural crops</li>
</ul>
<h3>Premium Rates</h3>
<ul>
<li><strong>Kharif crops:</strong> 2% of sum insured</li>
<li><strong>Rabi crops:</strong> 1.5% of sum insured</li>
<li><strong>Horticultural crops:</strong> 5% of sum insured</li>
</ul>',
                'eligibility' => 'All farmers including sharecroppers and tenant farmers growing notified crops in notified areas. Both loanee and non-loanee farmers can participate.',
                'benefits' => 'Full insurance cover for crop loss. Premium as low as 2% (Kharif), 1.5% (Rabi), 5% (horticulture). Rest premium paid by Government.',
                'application_process' => '1. Apply through CSC, bank, or pmfby.gov.in\n2. Submit land records and sowing certificate\n3. Premium payment through any mode\n4. Claim filed automatically based on crop cutting experiments',
                'required_documents' => 'Land records, Aadhaar Card, Bank account details, Sowing certificate from Patwari',
                'official_website' => 'https://pmfby.gov.in',
                'status' => 'active',
                'is_featured' => false,
            ],
            [
                'title' => 'Kisan Credit Card (KCC)',
                'slug' => 'kisan-credit-card',
                'category_id' => $cats['agriculture'] ?? 1,
                'state_id' => $central->id,
                'short_description' => 'Provides affordable credit to farmers for their agricultural needs including crop production, post-harvest expenses, and farm maintenance.',
                'content' => '<p>Kisan Credit Card (KCC) scheme was launched in 1998 to provide timely and adequate credit to farmers. The scheme has been extended to cover animal husbandry, fisheries, and allied agricultural activities.</p>
<h3>Benefits of KCC</h3>
<ul>
<li>Crop loan at 4% interest (with prompt repayment rebate)</li>
<li>Up to ₹3 lakh crop loan at subsidized rate</li>
<li>Insurance coverage under PMFBY</li>
<li>ATM-enabled debit card for easy withdrawal</li>
<li>No processing fee for loans up to ₹3 lakh</li>
</ul>',
                'eligibility' => 'Individual farmers, tenant farmers, sharecroppers, self-help groups, joint liability groups. Must have land records or be engaged in agriculture/allied activities.',
                'benefits' => 'Crop loan at 4% interest rate, insurance coverage, ATM card, flexible repayment, no collateral up to ₹1.6 lakh.',
                'application_process' => '1. Visit your nearest bank branch (any commercial bank, RRB, or cooperative bank)\n2. Fill KCC application form\n3. Submit land records, ID proof, and address proof\n4. Bank verifies and issues KCC within 15 days',
                'required_documents' => 'Land records, Aadhaar Card, Voter ID/Ration Card, Passport size photos, Declaration of land possession',
                'official_website' => 'https://www.nabard.org',
                'status' => 'active',
                'is_featured' => false,
            ],

            // ====== HOUSING ======
            [
                'title' => 'PM Awas Yojana - Gramin (Rural)',
                'slug' => 'pm-awas-yojana-gramin',
                'category_id' => $cats['housing'] ?? 4,
                'state_id' => $central->id,
                'short_description' => 'Provides pucca houses with basic amenities to houseless households and those living in kutcha/dilapidated houses in rural areas.',
                'content' => '<p>Pradhan Mantri Awaas Yojana - Gramin (PMAY-G) aims to provide a pucca house with basic amenities to all houseless households and those households living in kutcha and dilapidated houses by 2024.</p>
<h3>Financial Assistance</h3>
<ul>
<li><strong>Plain areas:</strong> ₹1,20,000 per unit</li>
<li><strong>Hilly/NE states:</strong> ₹1,30,000 per unit</li>
<li>Additional ₹12,000 for toilet construction</li>
<li>Convergence with MGNREGA for labour component (90-95 days)</li>
</ul>
<h3>Features</h3>
<ul>
<li>Ownership of house in the name of woman or joint ownership</li>
<li>Basic amenities: toilet, LPG connection, electricity, water supply</li>
<li>Convergence with other government schemes</li>
</ul>',
                'eligibility' => 'Houseless families or families living in kutcha/dilapidated houses. Priority to SC/ST, minorities, freed bonded laborers, women-headed households. BPL families as per SECC 2011 data.',
                'benefits' => '₹1,20,000-1,30,000 financial assistance for house construction, 90-95 days MGNREGA wages, toilet construction support.',
                'application_process' => '1. Apply through Gram Panchayat\n2. SECC data verification\n3. Priority list prepared by Gram Sabha\n4. House site selection\n5. Construction in phases with 3 installments',
                'required_documents' => 'Aadhaar Card, BPL Certificate, Bank account details, Land ownership/possession documents, MGNREGA job card',
                'official_website' => 'https://pmayg.nic.in',
                'status' => 'active',
                'is_featured' => true,
            ],
            [
                'title' => 'PM Awas Yojana - Urban',
                'slug' => 'pm-awas-yojana-urban',
                'category_id' => $cats['housing'] ?? 4,
                'state_id' => $central->id,
                'short_description' => 'Housing for All in Urban areas through Credit Linked Subsidy Scheme, in-situ slum redevelopment, and affordable housing partnerships.',
                'content' => '<p>Pradhan Mantri Awaas Yojana - Urban (PMAY-U) aims to provide housing for all in urban areas by 2022 (extended). The mission provides Central Assistance to Urban Local Bodies and other implementing agencies.</p>
<h3>Four Components</h3>
<ul>
<li><strong>In-Situ Slum Redevelopment (ISSR):</strong> Using land as resource to provide houses to slum dwellers</li>
<li><strong>Affordable Housing in Partnership (AHP):</strong> Partnership with public/private sector for affordable housing</li>
<li><strong>Credit Linked Subsidy Scheme (CLSS):</strong> Interest subsidy on home loans</li>
<li><strong>Beneficiary-Led Construction (BLC):</strong> Individual house construction/enhancement</li>
</ul>',
                'eligibility' => 'Economically Weaker Section (EWS) - income up to ₹3 lakh, Low Income Group (LIG) - ₹3-6 lakh, Middle Income Group (MIG-I) - ₹6-12 lakh, Middle Income Group (MIG-II) - ₹12-18 lakh.',
                'benefits' => 'Interest subsidy up to 6.5% on housing loans, ₹1.5 lakh for BLC, house under AHP component.',
                'application_process' => '1. Apply through pmaymis.gov.in or local urban body\n2. Select component (CLSS/AHP/BLC/ISSR)\n3. Submit income and identity documents\n4. Verification and approval\n5. Construction/loan disbursement',
                'required_documents' => 'Aadhaar Card, Income Certificate, Bank account details, Property documents (if applicable), Voter ID/Utility bills for address proof',
                'official_website' => 'https://pmaymis.gov.in',
                'status' => 'active',
                'is_featured' => false,
            ],

            // ====== HEALTH ======
            [
                'title' => 'Ayushman Bharat - PMJAY',
                'slug' => 'ayushman-bharat-pmjay',
                'category_id' => $cats['health'] ?? 2,
                'state_id' => $central->id,
                'short_description' => 'World\'s largest health insurance scheme providing ₹5 lakh per family per year for secondary and tertiary hospitalization to 55 crore beneficiaries.',
                'content' => '<p>Pradhan Mantri Jan Arogya Yojana (PM-JAY) is the world\'s largest health insurance scheme fully funded by the Government of India. It provides a health cover of ₹5 lakh per family per year.</p>
<h3>Key Features</h3>
<ul>
<li>₹5 lakh per family per year for secondary and tertiary care hospitalization</li>
<li>1,949 medical packages covering surgery, day care, ICU, and medicines</li>
<li>Cashless and paperless treatment at point of service</li>
<li>Portable across India at any empanelled hospital</li>
<li>Pre-existing diseases covered from day one</li>
</ul>',
                'eligibility' => 'Based on SECC 2011 data: Rural (7 crore families) - no land, manual labour, no male member 16-59, disabled, SC/ST, bonded labour. Urban: ragpickers, beggars, domestic workers, street vendors, construction workers, shop workers, etc.',
                'benefits' => '₹5 lakh per family per year health cover, cashless treatment at 29,000+ empanelled hospitals, 1,949 medical packages.',
                'application_process' => '1. Check eligibility at mera.pmjay.gov.in\n2. Get Ayushman card from nearest Common Service Centre\n3. Carry Ayushman card to any empanelled hospital\n4. Treatment is cashless and paperless',
                'required_documents' => 'Ration Card, Aadhaar Card, or any photo ID. For verification: SECC data reference number.',
                'official_website' => 'https://mera.pmjay.gov.in',
                'status' => 'active',
                'is_featured' => true,
            ],
            [
                'title' => 'Janani Suraksha Yojana (JSY)',
                'slug' => 'janani-suraksha-yojana',
                'category_id' => $cats['health'] ?? 2,
                'state_id' => $central->id,
                'short_description' => 'Safe motherhood intervention to reduce maternal and neonatal mortality by promoting institutional delivery among poor pregnant women.',
                'content' => '<p>Janani Suraksha Yojana (JSY) is a safe motherhood scheme under the National Health Mission. It provides cash assistance to pregnant women for institutional delivery.</p>
<h3>Cash Assistance</h3>
<ul>
<li><strong>Low performing states:</strong> ₹1,400 (rural), ₹1,000 (urban)</li>
<li><strong>High performing states:</strong> ₹700 (rural), ₹600 (urban)</li>
</ul>
<h3>Additional Benefits</h3>
<ul>
<li>Free delivery at government health facilities</li>
<li>Free transport to health facility</li>
<li>Free diet during stay</li>
</ul>',
                'eligibility' => 'Pregnant women belonging to BPL/SC/ST households. Age 19+ years. For institutional delivery only.',
                'benefits' => '₹600-1,400 cash assistance for institutional delivery, free delivery, free transport, free diet.',
                'application_process' => '1. Register at nearest Sub-Centre or Health Facility during pregnancy\n2. Get Mother-Child Protection (MCP) card\n3. Deliver at government health facility or empanelled private hospital\n4. Claim cash assistance after delivery',
                'required_documents' => 'BPL Certificate, Aadhaar Card, MCP Card, Bank account details',
                'official_website' => 'https://nhm.gov.in',
                'status' => 'active',
                'is_featured' => false,
            ],

            // ====== EMPLOYMENT ======
            [
                'title' => 'MGNREGA - Mahatma Gandhi NREGA',
                'slug' => 'mgnrega',
                'category_id' => $cats['employment'] ?? 5,
                'state_id' => $central->id,
                'short_description' => 'Guarantees 100 days of wage employment per year to every rural household whose adult members volunteer for unskilled manual work.',
                'content' => '<p>Mahatma Gandhi National Rural Employment Guarantee Act (MGNREGA) is the largest work guarantee programme in the world. Enacted in 2005, it provides a legal guarantee for 100 days of employment in every financial year to adult members of any rural household.</p>
<h3>Key Features</h3>
<ul>
<li>Legal guarantee of 100 days of employment per household per year</li>
<li>Wages paid through bank/post office accounts</li>
<li>Unemployment allowance if work not provided within 15 days</li>
<li>One-third participation reserved for women</li>
<li>Work site facilities: crèche, drinking water, first aid</li>
</ul>',
                'eligibility' => 'Any adult member of a rural household who volunteers for unskilled manual work. Must be 18+ years. Registered with Gram Panchayat.',
                'benefits' => '100 days guaranteed employment, daily wage (varies by state, ₹200-350), unemployment allowance, social security.',
                'application_process' => '1. Apply to Gram Panchayat with application form\n2. Get job card (within 15 days)\n3. Demand work at least 15 days before required date\n4. Work allocated within 15 days or get unemployment allowance',
                'required_documents' => 'Aadhaar Card, Bank account details, Address proof, Passport size photo',
                'official_website' => 'https://nrega.nic.in',
                'status' => 'active',
                'is_featured' => true,
            ],
            [
                'title' => 'PM Mudra Yojana',
                'slug' => 'pm-mudra-yojana',
                'category_id' => $cats['employment'] ?? 5,
                'state_id' => $central->id,
                'short_description' => 'Provides loans up to ₹10 lakh to non-corporate, non-farm small/micro enterprises for business setup and expansion.',
                'content' => '<p>Pradhan Mantri MUDRA Yojana (PMMY) was launched in 2015 to provide funding to the non-corporate, non-farm small/micro enterprises. MUDRA stands for Micro Units Development & Refinance Agency Ltd.</p>
<h3>Three Categories</h3>
<ul>
<li><strong>Shishu:</strong> Loans up to ₹50,000</li>
<li><strong>Kishore:</strong> Loans from ₹50,001 to ₹5,00,000</li>
<li><strong>Tarun:</strong> Loans from ₹5,00,001 to ₹10,00,000</li>
</ul>',
                'eligibility' => 'Any Indian citizen with a business plan for non-farm, non-corporate, small/micro enterprise. Must not be a defaulter to any bank/financial institution.',
                'benefits' => 'Loan up to ₹10 lakh without collateral, competitive interest rates, 100+ types of activities covered, no processing fee for Shishu loans.',
                'application_process' => '1. Prepare business plan\n2. Visit nearest bank, NBFC, or Mudra portal\n3. Apply for Shishu/Kishore/Tarun category\n4. Submit documents and wait for approval\n5. Loan disbursed within 7-10 days',
                'required_documents' => 'Aadhaar Card, PAN Card, Business plan, Address proof, Photograph, Quotations of assets (if applicable)',
                'official_website' => 'https://www.mudra.org.in',
                'status' => 'active',
                'is_featured' => false,
            ],
            [
                'title' => 'Stand-Up India Scheme',
                'slug' => 'stand-up-india-scheme',
                'category_id' => $cats['employment'] ?? 5,
                'state_id' => $central->id,
                'short_description' => 'Bank loans between ₹10 lakh to ₹1 crore for SC/ST and women entrepreneurs to set up greenfield enterprises.',
                'content' => '<p>Stand-Up India Scheme was launched in 2016 to facilitate bank loans between ₹10 lakh to ₹1 crore to at least one SC/ST borrower and at least one woman borrower per bank branch for setting up greenfield enterprises.</p>
<h3>Loan Details</h3>
<ul>
<li>Loan amount: ₹10 lakh to ₹1 crore</li>
<li>Composite loan covering 85% of project cost</li>
<li>Tenor: 7 years with moratorium period of 18 months</li>
<li>Interest rate: Base rate + 3% + Tenor premium</li>
</ul>',
                'eligibility' => 'SC/ST women entrepreneurs, or women entrepreneurs. Must be 18+ years. Enterprise must be greenfield (new venture). Must not be in default to any bank.',
                'benefits' => 'Loan ₹10 lakh to ₹1 crore, 85% project cost financing, 18 months moratorium, handholding support.',
                'application_process' => '1. Visit standupmitra.in portal\n2. Register and fill application\n3. Submit business plan\n4. Bank processes and sanctions loan\n5. Handholding support through journey',
                'required_documents' => 'Aadhaar Card, Caste Certificate (for SC/ST), Business plan, Education/Experience certificates, Address proof',
                'official_website' => 'https://www.standupmitra.in',
                'status' => 'active',
                'is_featured' => false,
            ],
            [
                'title' => 'Pradhan Mantri Rozgar Yojana (PMRY)',
                'slug' => 'pradhan-mantri-rozgar-yojana',
                'category_id' => $cats['employment'] ?? 5,
                'state_id' => $central->id,
                'short_description' => 'Provides employment to educated unemployed youth through self-employment ventures in industry, business, and service sectors.',
                'content' => '<p>PM Rozgar Yojana provides employment opportunities to educated unemployed youth by facilitating self-employment through industry, business, service, and farm sector ventures.</p>',
                'eligibility' => 'Educated unemployed youth aged 18-35 years (SC/ST: 18-40 years). Minimum 8th pass. Family income below ₹40,000 per annum.',
                'benefits' => 'Subsidized loans for self-employment ventures, skill training, marketing support.',
                'application_process' => '1. Apply through District Industries Centre\n2. Entrepreneurship training\n3. Project report preparation\n4. Bank loan processing',
                'required_documents' => 'Educational certificates, Aadhaar Card, Income Certificate, Caste Certificate (if applicable), Project report',
                'official_website' => 'https://www.msme.gov.in',
                'status' => 'active',
                'is_featured' => false,
            ],

            // ====== FINANCIAL INCLUSION ======
            [
                'title' => 'PM Jan Dhan Yojana',
                'slug' => 'pm-jan-dhan-yojana',
                'category_id' => $cats['financial-inclusion'] ?? 8,
                'state_id' => $central->id,
                'short_description' => 'National mission for financial inclusion providing zero balance bank accounts, debit cards, and insurance to every unbanked household.',
                'content' => '<p>Pradhan Mantri Jan Dhan Yojana (PMJDY) is India\'s flagship financial inclusion scheme launched on 28th August 2014. It provides universal access to banking facilities.</p>
<h3>Key Features</h3>
<ul>
<li>Zero balance savings bank account</li>
<li>RuPay debit card with ₹2 lakh accident insurance</li>
<li>Overdraft facility of ₹10,000</li>
<li>Direct Benefit Transfer (DBT) enabled</li>
<li>Mobile banking available</li>
</ul>',
                'eligibility' => 'Any Indian citizen above 10 years of age who does not have a bank account.',
                'benefits' => 'Zero balance account, ₹2 lakh accident insurance, ₹10,000 overdraft, RuPay debit card, mobile banking.',
                'application_process' => '1. Visit any bank branch or Business Correspondent\n2. Fill PMJDY application form\n3. Submit Aadhaar card\n4. Account opened on the spot\n5. RuPay card delivered within 7-10 days',
                'required_documents' => 'Aadhaar Card (or any valid ID with Aadhaar number), Passport size photograph',
                'official_website' => 'https://www.pmjjdy.gov.in',
                'status' => 'active',
                'is_featured' => true,
            ],
            [
                'title' => 'Atal Pension Yojana (APY)',
                'slug' => 'atal-pension-yojana',
                'category_id' => $cats['financial-inclusion'] ?? 8,
                'state_id' => $central->id,
                'short_description' => 'Government guaranteed minimum pension of ₹1,000 to ₹5,000 per month for workers in the unorganised sector after age 60.',
                'content' => '<p>Atal Pension Yojana is a pension scheme for workers in the unorganised sector. It provides a guaranteed minimum pension of ₹1,000 to ₹5,000 per month after the age of 60 years.</p>
<h3>Pension Options</h3>
<table>
<tr><th>Monthly Pension</th><th>Age 25</th><th>Age 30</th><th>Age 35</th><th>Age 40</th></tr>
<tr><td>₹1,000</td><td>₹42</td><td>₹57</td><td>₹90</td><td>₹145</td></tr>
<tr><td>₹2,000</td><td>₹84</td><td>₹114</td><td>₹180</td><td>₹290</td></tr>
<tr><td>₹3,000</td><td>₹126</td><td>₹171</td><td>₹270</td><td>₹435</td></tr>
<tr><td>₹4,000</td><td>₹168</td><td>₹228</td><td>₹360</td><td>₹580</td></tr>
<tr><td>₹5,000</td><td>₹210</td><td>₹285</td><td>₹450</td><td>₹725</td></tr>
</table>',
                'eligibility' => 'Indian citizens aged 18-40 years. Must have a savings bank account. Must have Aadhaar card. Not an income taxpayer.',
                'benefits' => 'Guaranteed pension ₹1,000-5,000/month, government co-contribution (50% up to ₹1,000 for 5 years), tax benefits.',
                'application_process' => '1. Visit bank/post office where savings account exists\n2. Fill APY registration form\n3. Provide Aadhaar and bank details\n4. Choose pension amount\n5. Auto-debit from bank account monthly',
                'required_documents' => 'Savings bank account, Aadhaar Card, Mobile number',
                'official_website' => 'https://www.npscra.nsdl.co.in',
                'status' => 'active',
                'is_featured' => false,
            ],
            [
                'title' => 'National Pension Scheme (NPS)',
                'slug' => 'national-pension-scheme',
                'category_id' => $cats['financial-inclusion'] ?? 8,
                'state_id' => $central->id,
                'short_description' => 'Government-regulated pension scheme providing market-linked returns with tax benefits for retirement planning.',
                'content' => '<p>National Pension System (NPS) is a voluntary defined contribution pension system regulated by PFRDA. It provides market-linked returns and tax benefits.</p>
<h3>Key Features</h3>
<ul>
<li>Market-linked returns (equity + debt)</li>
<li>Tax benefits up to ₹2 lakh under Section 80C and 80CCD</li>
<li>Low fund management charges</li>
<li>Portable across jobs and locations</li>
<li>Partial withdrawal allowed (up to 25%)</li>
</ul>',
                'eligibility' => 'Indian citizens aged 18-65 years. Both employed and self-employed can join.',
                'benefits' => 'Market-linked returns, tax benefits up to ₹2 lakh, low charges, portability, partial withdrawal facility.',
                'application_process' => '1. Visit any POP (Point of Presence) or NSDL website\n2. Fill NPS registration form\n3. Submit KYC documents\n4. Initial contribution (min ₹500)\n5. PRAN (Permanent Retirement Account Number) allotted',
                'required_documents' => 'Aadhaar Card, PAN Card, Bank account details, Passport size photo',
                'official_website' => 'https://www.npscra.nsdl.co.in',
                'status' => 'active',
                'is_featured' => false,
            ],

            // ====== SOCIAL WELFARE ======
            [
                'title' => 'PM Garib Kalyan Anna Yojana',
                'slug' => 'pm-garib-kalyan-anna-yojana',
                'category_id' => $cats['social-welfare'] ?? 6,
                'state_id' => $central->id,
                'short_description' => 'Provides free food grains (5 kg per person per month) to over 80 crore beneficiaries under the National Food Security Act.',
                'content' => '<p>Pradhan Mantri Garib Kalyan Anna Yojana (PMGKAY) provides free food grains to beneficiaries under the National Food Security Act. The scheme was launched during COVID-19 and has been extended.</p>
<h3>Benefits</h3>
<ul>
<li>5 kg food grains per person per month FREE (rice, wheat, or millets)</li>
<li>Over 80 crore beneficiaries covered</li>
<li>Additional 5 kg under NFSA (now free)</li>
<li>Total 10 kg per person per month (5 kg NFSA + 5 kg PMGKAY)</li>
</ul>',
                'eligibility' => 'All beneficiaries under National Food Security Act (NFSA) - Antyodaya Anna Yojana (AAY) and Priority Households (PHH).',
                'benefits' => '5 kg free food grains per person per month, total 10 kg including NFSA allocation.',
                'application_process' => '1. Apply for NFSA through state food department\n2. Ration card issued\n3. Collect free grains from FPS (Fair Price Shop) using Aadhaar/Ration card',
                'required_documents' => 'Ration Card, Aadhaar Card',
                'official_website' => 'https://food.gov.in',
                'status' => 'active',
                'is_featured' => true,
            ],
            [
                'title' => 'PM Ujjwala Yojana',
                'slug' => 'pm-ujjwala-yojana',
                'category_id' => $cats['social-welfare'] ?? 6,
                'state_id' => $central->id,
                'short_description' => 'Provides free LPG connections to women from BPL households to ensure clean cooking fuel and reduce health hazards from solid fuels.',
                'content' => '<p>Pradhan Mantri Ujjwala Yojana provides free LPG connections to women from BPL households. The scheme was launched in 2016 and aims to replace unhealthy cooking fuels.</p>
<h3>Benefits Under Ujjwala 2.0</h3>
<ul>
<li>Free LPG connection (deposit, regulator, cylinder, hose, gas stove)</li>
<li>First refill cylinder free</li>
<li>Security deposit waived</li>
<li>Over 9.5 crore LPG connections delivered</li>
</ul>',
                'eligibility' => 'Women from BPL households (SECC list), women from SC/ST, Antyodaya Anna Yojana families, forest dwellers, primitive tribal groups, most backward classes.',
                'benefits' => 'Free LPG connection with equipment, first refill free, clean cooking fuel.',
                'application_process' => '1. Apply at nearest LPG distributor\n2. Submit BPL certificate and Aadhaar\n3. KYC verification\n4. Connection issued within 7 days',
                'required_documents' => 'BPL/AAY Ration Card, Aadhaar Card, Bank account details, Passport size photo',
                'official_website' => 'https://pmuy.gov.in',
                'status' => 'active',
                'is_featured' => false,
            ],

            // ====== WOMEN & CHILD ======
            [
                'title' => 'Sukanya Samriddhi Yojana',
                'slug' => 'sukanya-samriddhi-yojana',
                'category_id' => $cats['women-child'] ?? 7,
                'state_id' => $central->id,
                'short_description' => 'Small deposit scheme for girl children with highest interest rate (8.2%) and tax benefits for secure future education and marriage expenses.',
                'content' => '<p>Sukanya Samriddhi Yojana (SSY) is a government-backed savings scheme for girl children. It offers one of the highest interest rates among small savings schemes.</p>
<h3>Key Features</h3>
<ul>
<li>Interest rate: 8.2% per annum (compounded annually)</li>
<li>Minimum deposit: ₹250 per year</li>
<li>Maximum deposit: ₹1,50,000 per year</li>
<li>Tax benefits under Section 80C (up to ₹1.5 lakh)</li>
<li>Maturity amount completely tax-free</li>
<li>Tenure: 21 years from account opening</li>
</ul>',
                'eligibility' => 'Girl child below 10 years of age. Maximum 2 accounts per family. One account per girl child.',
                'benefits' => '8.2% interest rate (highest among small savings), full tax exemption, partial withdrawal at 18 for education.',
                'application_process' => '1. Visit any post office or authorized bank\n2. Fill SSY account opening form\n3. Submit girl child birth certificate\n4. Initial deposit (min ₹250)\n5. Annual deposit between April-March',
                'required_documents' => 'Birth certificate of girl child, Aadhaar of parent/guardian, Address proof, Passport size photos',
                'official_website' => 'https://www.indiapost.gov.in',
                'status' => 'active',
                'is_featured' => true,
            ],
            [
                'title' => 'Beti Bachao Beti Padhao',
                'slug' => 'beti-bachao-beti-padhao',
                'category_id' => $cats['women-child'] ?? 7,
                'state_id' => $central->id,
                'short_description' => 'Multi-sectoral initiative to address declining Child Sex Ratio, enforce Girl Child education, and prevent gender-biased sex selection.',
                'content' => '<p>Beti Bachao Beti Padhao (BBBP) is a joint initiative of Ministry of Women & Child Development, Ministry of Health, and Ministry of Education. Launched on 22nd January 2015.</p>
<h3>Objectives</h3>
<ul>
<li>Prevent gender-biased sex selection</li>
<li>Ensure survival and protection of the girl child</li>
<li>Ensure education and participation of the girl child</li>
</ul>
<h3>Key Components</h3>
<ul>
<li>Sukanya Samriddhi Account for girl children</li>
<li>Awareness campaigns and community mobilization</li>
<li>Multi-sectoral action in 100+ districts with low CSR</li>
</ul>',
                'eligibility' => 'All girl children and their families in India. Special focus on districts with low Child Sex Ratio.',
                'benefits' => 'Awareness and protection of girl child rights, education support, community-level interventions.',
                'application_process' => 'Awareness campaigns run by government. Citizens can participate through local administration. SSY account can be opened at any bank/post office.',
                'required_documents' => 'For SSY: Birth certificate of girl child, parent Aadhaar',
                'official_website' => 'https://betibachao.gov.in',
                'status' => 'active',
                'is_featured' => false,
            ],
            [
                'title' => 'PM Matru Vandana Yojana',
                'slug' => 'pm-matru-vandana-yojana',
                'category_id' => $cats['women-child'] ?? 7,
                'state_id' => $central->id,
                'short_description' => 'Provides ₹5,000 cash incentive to pregnant and lactating women for first living child for partial compensation of wage loss.',
                'content' => '<p>Pradhan Mantri Matru Vandana Yojana (PMMVY) provides cash incentive of ₹5,000 to pregnant and lactating mothers for first living child. It compensates for wage loss during pregnancy and after childbirth.</p>
<h3>Benefits</h3>
<ul>
<li>₹5,000 in 3 installments</li>
<li>Cash transfer directly to bank/post office account</li>
<li>First installment: ₹1,000 after registration</li>
<li>Second installment: ₹2,000 after 6 months of pregnancy</li>
<li>Third installment: ₹2,000 after child birth and immunization</li>
</ul>',
                'eligibility' => 'All pregnant and lactating mothers for first living child (excluding girls born under BBBP). Must be 19+ years. Must have registered at health facility.',
                'benefits' => '₹5,000 cash incentive in 3 installments, direct bank transfer.',
                'application_process' => '1. Register at nearest Health/Facility/ASHA\n2. Submit application with Aadhaar and bank details\n3. First installment after registration\n4. Second installment after 6 months\n5. Third installment after delivery',
                'required_documents' => 'Aadhaar Card, Bank account details, Child birth registration, Health facility registration',
                'official_website' => 'https://wcd.nic.in',
                'status' => 'active',
                'is_featured' => false,
            ],

            // ====== DIGITAL INDIA ======
            [
                'title' => 'Digital India Programme',
                'slug' => 'digital-india-programme',
                'category_id' => $cats['digital-india'] ?? 9,
                'state_id' => $central->id,
                'short_description' => 'Umbrella initiative for digital infrastructure, digital governance, digital literacy, and digital empowerment of citizens.',
                'content' => '<p>Digital India is a flagship programme of the Government of India to transform India into a digitally empowered society and knowledge economy. Launched on 1st July 2015.</p>
<h3>Three Core Components</h3>
<ul>
<li><strong>Digital Infrastructure:</strong> Broadband highways, universal access to mobile connectivity, public internet access programme</li>
<li><strong>Governance & Services:</strong> e-Governance, e-Kranti, information for all</li>
<li><strong>Digital Empowerment:</strong> Digital literacy, digital resources, industry digitization</li>
</ul>
<h3>Key Schemes Under Digital India</h3>
<ul>
<li>BharatNet (broadband to villages)</li>
<li>DigiLocker (digital document storage)</li>
<li>e-Sign (digital signatures)</li>
<li>UMANG (unified government services app)</li>
</ul>',
                'eligibility' => 'All Indian citizens. Various sub-schemes have specific eligibility.',
                'benefits' => 'Digital infrastructure access, e-governance services, digital literacy, DigiLocker, UMANG app.',
                'application_process' => 'Varies by sub-scheme. UMANG app available on Google Play and App Store. DigiLocker at digilocker.gov.in.',
                'required_documents' => 'Aadhaar Card for most services',
                'official_website' => 'https://digitalindia.gov.in',
                'status' => 'active',
                'is_featured' => false,
            ],

            // ====== INFRASTRUCTURE ======
            [
                'title' => 'Swachh Bharat Mission',
                'slug' => 'swachh-bharat-mission',
                'category_id' => $cats['infrastructure'] ?? 10,
                'state_id' => $central->id,
                'short_description' => 'India\'s largest cleanliness drive to achieve universal sanitation coverage by providing individual household toilets and solid waste management.',
                'content' => '<p>Swachh Bharat Mission (SBM) was launched on 2nd October 2014 to achieve universal sanitation coverage. It has two components: Urban and Rural.</p>
<h3>SBM - Gramin (Rural)</h3>
<ul>
<li>Individual Household Latrines (IHHLs)</li>
<li>Community and Public Sanitation Facilities</li>
<li>Solid and Liquid Waste Management</li>
<li>Over 11 crore toilets built</li>
</ul>
<h3>SBM - Urban</h3>
<ul>
<li>Toilet construction and renovation</li>
<li>Door-to-door waste collection</li>
<li>Waste processing and disposal</li>
<li>ODF (Open Defecation Free) certification</li>
</ul>',
                'eligibility' => 'Rural: BPL households, SC/ST, women-headed households, persons with disabilities. Urban: All urban households.',
                'benefits' => '₹12,000 for toilet construction (rural), ₹15,000 (urban), community toilet support, solid waste management.',
                'application_process' => '1. Apply through Gram Panchayat (rural) or ULB (urban)\n2. Verification and approval\n3. Toilet construction\n4. ODF verification and certification',
                'required_documents' => 'Aadhaar Card, BPL certificate (for rural), Bank account details, House ownership proof',
                'official_website' => 'https://swachhbharat.gov.in',
                'status' => 'active',
                'is_featured' => false,
            ],

            // ====== ENVIRONMENT ======
            [
                'title' => 'PM-KUSUM Solar Pump Scheme',
                'slug' => 'pm-kusum-solar-pump-scheme',
                'category_id' => $cats['environment'] ?? 11,
                'state_id' => $central->id,
                'short_description' => 'Provides solar-powered agricultural pumps and solar power plants to farmers, reducing dependence on diesel and grid electricity.',
                'content' => '<p>PM-KUSUM (Pradhan Mantri Kisan Urja Suraksha evam Utthaan Mahabhiyan) scheme provides solar energy solutions to farmers. It has three components.</p>
<h3>Components</h3>
<ul>
<li><strong>Component A:</strong> Standalone solar powered agriculture pumps (up to 7.5 HP)</li>
<li><strong>Component B:</strong> Solarization of existing agriculture pumps</li>
<li><strong>Component C:</strong> Installation of grid-connected solar power plants (500 kW to 2 MW)</li>
</ul>
<h3>Subsidy</h3>
<ul>
<li>Central subsidy: 30-60% depending on category</li>
<li>State subsidy: additional 30%</li>
<li>Farmer pays only 10-40%</li>
</ul>',
                'eligibility' => 'All farmers (individual or group), FPOs, cooperatives. Must have agriculture land and existing/bore well.',
                'benefits' => 'Solar pump at 10-40% cost, additional income from selling surplus power, reduced electricity bills.',
                'application_process' => '1. Apply through state agriculture department or DISCOM\n2. Select component (A/B/C)\n3. Vendor selection and installation\n4. Subsidy disbursement',
                'required_documents' => 'Land records, Aadhaar Card, Bank account, Electricity connection details, Bore well details',
                'official_website' => 'https://pmkusum.gov.in',
                'status' => 'active',
                'is_featured' => false,
            ],

            // ====== SENIOR CITIZEN ======
            [
                'title' => 'Pradhan Mantri Vay Vandana Yojana (PMVVY)',
                'slug' => 'pradhan-mantri-vay-vandana-yojana',
                'category_id' => $cats['senior-citizen'] ?? 12,
                'state_id' => $central->id,
                'short_description' => 'Pension scheme for senior citizens providing assured pension of 8% per annum for 10 years with investment up to ₹15 lakh.',
                'content' => '<p>Pradhan Mantri Vay Vandana Yojana is a pension scheme exclusively for senior citizens aged 60 years and above. It provides guaranteed pension with life insurance cover.</p>
<h3>Key Features</h3>
<ul>
<li>Assured pension: 8% per annum</li>
<li>Investment limit: ₹15 lakh</li>
<li>Pension payment: monthly, quarterly, half-yearly, or annually</li>
<li>Loan facility: up to 75% of deposit after 3 years</li>
<li>Maturity benefit: full deposit refund</li>
<li>Life insurance: proportionate to pension amount</li>
</ul>',
                'eligibility' => 'Senior citizens aged 60 years and above. Maximum investment ₹15 lakh.',
                'benefits' => '8% assured pension, ₹15 lakh max investment, loan facility, life insurance cover.',
                'application_process' => '1. Visit LIC office or online at licindia.in\n2. Fill PMVVY application form\n3. Submit KYC documents\n4. Investment amount\n5. Pension starts immediately',
                'required_documents' => 'Aadhaar Card, PAN Card, Bank account details, Passport size photos, Age proof',
                'official_website' => 'https://licindia.in',
                'status' => 'active',
                'is_featured' => false,
            ],

            // ====== EDUCATION ======
            [
                'title' => 'PM Scholarship Scheme',
                'slug' => 'pm-scholarship-scheme',
                'category_id' => $cats['education'] ?? 1,
                'state_id' => $central->id,
                'short_description' => 'Scholarship for wards of ex-servicemen, widows, and war casualties for professional degree and technical courses.',
                'content' => '<p>PM Scholarship Scheme provides financial assistance to wards of ex-servicemen, widows, and war casualties for pursuing professional degree courses.</p>
<h3>Scholarship Amount</h3>
<ul>
<li>Boys: ₹2,500 per month (professional), ₹3,000 (technical)</li>
<li>Girls: ₹3,000 per month (professional), ₹3,600 (technical)</li>
<li>Duration: Full course period</li>
</ul>',
                'eligibility' => 'Wards of ex-servicemen, war widows, children of ex-servicemen killed in action. Must be pursuing professional degree courses.',
                'benefits' => '₹2,500-3,600 per month scholarship, full course duration coverage.',
                'application_process' => '1. Apply online at rkfy.nic.in\n2. Submit academic and service records\n3. Verification by ZSB/RSB\n4. Scholarship sanctioned',
                'required_documents' => 'Ex-serviceman certificate, Academic records, Bank account, Aadhaar Card, Admission letter',
                'official_website' => 'https://rkfy.nic.in',
                'status' => 'active',
                'is_featured' => false,
            ],
            [
                'title' => 'National Scholarship Portal (NSP)',
                'slug' => 'national-scholarship-portal',
                'category_id' => $cats['education'] ?? 1,
                'state_id' => $central->id,
                'short_description' => 'One-stop platform for all scholarship schemes from Class 1 to PhD level, including SC/ST/OBC/Minority and meritorious students.',
                'content' => '<p>National Scholarship Portal is a digital platform for all government scholarships. It covers scholarships from Class 1 to PhD level across various categories.</p>
<h3>Scholarships Available</h3>
<ul>
<li>Pre-Matric Scholarships (Class 1-10)</li>
<li>Post-Matric Scholarships (Class 11-PhD)</li>
<li>Merit-cum-Means Scholarships</li>
<li>Top Class Education Scheme</li>
<li>National Means Cum Merit Scholarship</li>
<li>Various state and minority scholarships</li>
</ul>',
                'eligibility' => 'Students from SC/ST/OBC/Minority/EWS categories. Merit-based and means-based criteria vary by scholarship.',
                'benefits' => 'Multiple scholarships available, single platform application, direct bank transfer, transparency.',
                'application_process' => '1. Visit scholarships.gov.in\n2. Register with Aadhaar\n3. Fill application form\n4. Upload documents\n5. Submit to institution for verification',
                'required_documents' => 'Aadhaar Card, Bank account, Income Certificate, Caste Certificate (if applicable), Previous year marksheets, Admission letter',
                'official_website' => 'https://scholarships.gov.in',
                'status' => 'active',
                'is_featured' => true,
            ],
        ];

        foreach ($schemes as $data) {
            // Set published_at if not set
            if (!isset($data['published_at'])) {
                $data['published_at'] = now();
            }
            if (!isset($data['meta_title'])) {
                $data['meta_title'] = $data['title'] . ' - UmangIndia';
            }
            if (!isset($data['meta_description'])) {
                $data['meta_description'] = \Illuminate\Support\Str::limit(strip_tags($data['short_description']), 160);
            }
            if (!isset($data['meta_keywords'])) {
                $data['meta_keywords'] = strtolower($data['title']) . ', sarkari yojana, government scheme, umangindia';
            }

            Scheme::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
