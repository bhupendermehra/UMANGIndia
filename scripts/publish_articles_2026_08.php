<?php
// publish_articles_2026_08.php — Insert 10 new SEO articles (Phase B roadmap).
// Run: php scripts/publish_articles_2026_08.php
// All content: real, accurate scheme info; uncertain figures say "as per official portal".

require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Article;

$articles = [
    [
        'title' => 'PM Kisan 19th Instalment: Status Check & Beneficiary List 2026',
        'slug' => 'pm-kisan-19th-instalment-status-check-2026',
        'excerpt' => 'Check PM Kisan 19th instalment status online, see the full beneficiary list and learn how to fix eKYC or bank issues before the next payment.',
        'meta_title' => 'PM Kisan 19th Instalment: Status Check & Beneficiary List 2026',
        'meta_description' => 'Check PM Kisan 19th instalment status online, view the beneficiary list, and fix eKYC or bank issues before the next payment.',
        'focus_keyword' => 'PM Kisan 19th instalment status check',
        'content' => <<<'HTML'
<h2>PM Kisan 19th Instalment: What Farmers Need to Know</h2>
<p>The PM Kisan Samman Nidhi Yojana transfers Rs 6,000 per year to eligible farming families in three equal instalments of Rs 2,000 each. The 19th instalment continues this support for verified beneficiaries whose eKYC and bank details are complete.</p>
<p>Only farmers whose Aadhaar-based eKYC is done and whose bank account is linked with the PM Kisan portal receive the payment. Farmers with pending eKYC or failed payment status do not get the instalment.</p>

<h2>How to Check PM Kisan 19th Instalment Status Online</h2>
<p>Follow these steps on the official PM Kisan portal to check your beneficiary status:</p>
<ol>
<li>Visit the official PM Kisan portal (pmkisan.gov.in).</li>
<li>Click on "Farmers Corner" and select "Beneficiary Status".</li>
<li>Enter your Aadhaar number or account number, and fill the captcha.</li>
<li>Click "Get Data" to see your instalment status and payment history.</li>
</ol>
<p>Your status will show one of: "Beneficiary", "Payment processed", "Failed payment", or "eKYC pending".</p>

<h2>PM Kisan Beneficiary List 2026</h2>
<p>The full beneficiary list is available on the PM Kisan portal in PDF format, sorted state-wise and district-wise. You can also search your name through the "Beneficiary List" option under Farmers Corner.</p>

<h2>Why Payments Fail and How to Fix Them</h2>
<p>The most common reasons for failed PM Kisan payments are:</p>
<ul>
<li>Pending Aadhaar-based eKYC on the portal.</li>
<li>Bank account not linked with Aadhaar or the PM Kisan record.</li>
<li>Incorrect bank account or IFSC details in the farmer database.</li>
<li>Land records not updated in the state revenue department.</li>
</ul>
<p>To fix these, complete your eKYC by OTP or biometric on the portal, update your bank details under "Edit Bank Account", and confirm your land records with the local agriculture officer.</p>

<h2>Frequently Asked Questions</h2>
<h3>When will the PM Kisan 19th instalment be released?</h3>
<p>The instalment dates are announced by the government on the official portal. Payments are typically released in phases state-wise, so the exact date varies by state.</p>
<h3>How much amount is paid in each PM Kisan instalment?</h3>
<p>Rs 2,000 is transferred per instalment, three times a year, totalling Rs 6,000 annually to each eligible family.</p>
<h3>I am a beneficiary but did not get the payment. What should I do?</h3>
<p>Check your status on the portal, complete eKYC, verify bank details, and contact the state nodal officer or your local agriculture department if the issue continues.</p>
HTML,
        'faqs' => [
            ['question' => 'When will the PM Kisan 19th instalment be released?', 'answer' => 'The instalment dates are announced by the government on the official portal. Payments are typically released in phases state-wise, so the exact date varies by state.'],
            ['question' => 'How much amount is paid in each PM Kisan instalment?', 'answer' => 'Rs 2,000 is transferred per instalment, three times a year, totalling Rs 6,000 annually to each eligible family.'],
            ['question' => 'I am a beneficiary but did not get the payment. What should I do?', 'answer' => 'Check your status on the portal, complete eKYC, verify bank details, and contact the state nodal officer or your local agriculture department if the issue continues.'],
        ],
    ],
    [
        'title' => 'Kisan Credit Card Online Apply: Documents & Eligibility 2026',
        'slug' => 'kisan-credit-card-online-apply-2026',
        'excerpt' => 'Complete guide to apply for a Kisan Credit Card online in 2026 — eligibility, documents, interest rate, and how to get up to Rs 3 lakh without collateral.',
        'meta_title' => 'Kisan Credit Card Online Apply: Eligibility, Documents 2026',
        'meta_description' => 'Apply for a Kisan Credit Card online in 2026. Check eligibility, required documents, interest rate and how to get credit without collateral.',
        'focus_keyword' => 'Kisan Credit Card online apply',
        'content' => <<<'HTML'
<h2>What Is a Kisan Credit Card?</h2>
<p>The Kisan Credit Card (KCC) is a credit facility for farmers that covers crop production, post-harvest needs, farm maintenance, and other agriculture-related expenses. It works like a revolving credit line, so you pay interest only on the amount you actually use.</p>
<p>The scheme is implemented by all major banks, including public sector banks, cooperative banks, and regional rural banks, with a government interest subvention for timely repayment.</p>

<h2>Eligibility for Kisan Credit Card 2026</h2>
<ul>
<li>All farmers, including tenant farmers, sharecroppers, and oral lessees.</li>
<li>Farmer producer organisations (FPOs) and joint liability groups.</li>
<li>Fisheries and animal husbandry farmers.</li>
<li>Farmers with valid land records or a certificate from the village authority.</li>
</ul>

<h2>Documents Required</h2>
<ol>
<li>Passport-size photograph.</li>
<li>Identity proof: Aadhaar card, Voter ID, or Passport.</li>
<li>Address proof: Aadhaar, electricity bill, or bank passbook.</li>
<li>Land records or cultivation proof issued by the revenue department.</li>
<li>Bank account details of the nearest branch.</li>
</ol>

<h2>How to Apply Online</h2>
<p>You can apply through your bank's net banking portal, the bank's mobile app, or by visiting the nearest branch with your documents. Many banks also accept KCC applications through the common service centres (CSCs).</p>
<p>After submission, the bank verifies your land records and sanction is usually done within a few weeks. The card limit is based on your land holding, crop pattern, and repayment history.</p>

<h2>Interest Rate and Subsidy</h2>
<p>KCC loans up to Rs 3 lakh are available without collateral. As per the official portal, farmers who repay on time get an interest subvention benefit, which effectively reduces the interest cost. Check your bank's current rates for the exact figure.</p>

<h2>Frequently Asked Questions</h2>
<h3>Can I apply for a Kisan Credit Card without land documents?</h3>
<p>Tenant farmers and sharecroppers can apply with a certificate from the local authority or the farmer producer organisation they are associated with.</p>
<h3>How much credit can I get under KCC?</h3>
<p>The limit depends on your land holding and crop pattern. Loans up to Rs 3 lakh do not require collateral.</p>
<h3>Is KCC available for animal husbandry and fisheries?</h3>
<p>Yes, the KCC facility has been extended to animal husbandry and fisheries farmers as well.</p>
HTML,
        'faqs' => [
            ['question' => 'Can I apply for a Kisan Credit Card without land documents?', 'answer' => 'Tenant farmers and sharecroppers can apply with a certificate from the local authority or the farmer producer organisation they are associated with.'],
            ['question' => 'How much credit can I get under KCC?', 'answer' => 'The limit depends on your land holding and crop pattern. Loans up to Rs 3 lakh do not require collateral.'],
            ['question' => 'Is KCC available for animal husbandry and fisheries?', 'answer' => 'Yes, the KCC facility has been extended to animal husbandry and fisheries farmers as well.'],
        ],
    ],
    [
        'title' => 'PM Ujjwala Yojana 2026: Free LPG Connection, Eligibility & Documents',
        'slug' => 'pm-ujjwala-yojana-free-lpg-connection-2026',
        'excerpt' => 'PM Ujjwala Yojana gives free LPG connections to poor households. Check 2026 eligibility, documents needed, and how to apply for a new connection.',
        'meta_title' => 'PM Ujjwala Yojana 2026: Free LPG Connection & Eligibility',
        'meta_description' => 'Get a free LPG connection under PM Ujjwala Yojana. Check 2026 eligibility, documents required, and the online application process.',
        'focus_keyword' => 'PM Ujjwala Yojana free LPG connection',
        'content' => <<<'HTML'
<h2>What Is PM Ujjwala Yojana?</h2>
<p>Pradhan Mantri Ujjwala Yojana (PMUY) provides free LPG connections to women from below-poverty-line households. The scheme was launched to replace harmful cooking fuels like wood and cow dung with clean LPG.</p>
<p>Eligible households receive a free connection with the first refill and a stove in the Ujjwala 2.0 version, making the scheme a major push for clean cooking energy.</p>

<h2>Eligibility Criteria 2026</h2>
<ul>
<li>The applicant must be a woman aged 18 years or above.</li>
<li>The household must not already own an LPG connection in any name.</li>
<li>The applicant must belong to a family covered under the SECC 2011 list or specific beneficiary categories.</li>
<li>The household must have a valid Aadhaar card of the applicant.</li>
</ul>

<h2>Documents Required</h2>
<ol>
<li>Application form (available at the LPG distributor).</li>
<li>Aadhaar card of the applicant.</li>
<li>BPL certificate or SECC data verification.</li>
<li>Bank account details for the subsidy amount.</li>
<li>Ration card, if available.</li>
</ol>

<h2>How to Apply for PM Ujjwala Yojana</h2>
<p>Visit your nearest LPG distributor with the documents and fill the application form, or apply through the official PMUY portal. After verification, the connection is released and the subsidy is transferred to the beneficiary's bank account.</p>

<h2>Benefits Under PM Ujjwala</h2>
<p>Apart from the free connection, beneficiaries receive the first LPG refill and a stove under Ujjwala 2.0. The scheme also promotes the use of clean fuel, which reduces indoor air pollution and health problems in rural households.</p>

<h2>Frequently Asked Questions</h2>
<h3>Who can get an LPG connection under PM Ujjwala Yojana?</h3>
<p>Women aged 18 or above from households listed under SECC 2011 or specified beneficiary categories, who do not already have an LPG connection.</p>
<h3>Is the PM Ujjwala connection completely free?</h3>
<p>The connection, first refill, and stove are provided free under Ujjwala 2.0 for eligible beneficiaries. The exact package is as per the official portal.</p>
<h3>What should I do if my name is in the SECC list but I did not get a connection?</h3>
<p>Contact your LPG distributor or the district nodal officer with your SECC details and Aadhaar to get your application processed.</p>
HTML,
        'faqs' => [
            ['question' => 'Who can get an LPG connection under PM Ujjwala Yojana?', 'answer' => 'Women aged 18 or above from households listed under SECC 2011 or specified beneficiary categories, who do not already have an LPG connection.'],
            ['question' => 'Is the PM Ujjwala connection completely free?', 'answer' => 'The connection, first refill, and stove are provided free under Ujjwala 2.0 for eligible beneficiaries. The exact package is as per the official portal.'],
            ['question' => 'What should I do if my name is in the SECC list but I did not get a connection?', 'answer' => 'Contact your LPG distributor or the district nodal officer with your SECC details and Aadhaar to get your application processed.'],
        ],
    ],
    [
        'title' => 'Atal Pension Yojana vs NPS: Which Retirement Scheme Is Better?',
        'slug' => 'atal-pension-yojana-vs-nps-comparison',
        'excerpt' => 'Compare Atal Pension Yojana and National Pension Scheme on pension amount, tax benefits, and flexibility to choose the right retirement plan.',
        'meta_title' => 'Atal Pension Yojana vs NPS: Which Is Better in 2026?',
        'meta_description' => 'Compare Atal Pension Yojana and NPS on monthly pension, tax benefits, market exposure and flexibility to pick the right retirement scheme.',
        'focus_keyword' => 'Atal Pension Yojana vs NPS',
        'content' => <<<'HTML'
<h2>APY vs NPS: Two Different Retirement Solutions</h2>
<p>Atal Pension Yojana (APY) and National Pension Scheme (NPS) both build a retirement corpus, but they are designed for different needs. APY guarantees a fixed monthly pension, while NPS invests in the market and gives returns based on fund performance.</p>

<h2>Key Differences at a Glance</h2>
<ul>
<li><strong>Guaranteed pension:</strong> APY guarantees a fixed monthly pension of Rs 1,000 to Rs 5,000. NPS returns depend on market-linked investments.</li>
<li><strong>Who can join:</strong> APY is for citizens aged 18-40 with a bank account. NPS is open to all citizens and also mandatory for government employees.</li>
<li><strong>Tax benefits:</strong> Both offer deductions under Section 80CCD. NPS provides an additional deduction under Section 80CCD(1B) up to Rs 50,000.</li>
<li><strong>Withdrawal flexibility:</strong> NPS allows partial withdrawals for specific purposes. APY allows exit only under specified conditions before the age of 60.</li>
<li><strong>Market exposure:</strong> APY mostly invests in government securities and corporate bonds. NPS lets you choose equity allocation up to 75%.</li>
</ul>

<h2>Which One Should You Choose?</h2>
<p>If you want a safe, guaranteed pension with minimal effort, APY is the better choice. If you are comfortable with market risk and want potentially higher returns with more flexibility, NPS suits you better. Many people use both: APY for the assured base pension and NPS for the growth component.</p>

<h2>Frequently Asked Questions</h2>
<h3>Can I have both APY and NPS accounts?</h3>
<p>Yes, both schemes can be held together. The pension from APY and NPS are separate, and both provide tax benefits.</p>
<h3>What happens if I stop paying APY contributions?</h3>
<p>If contributions stop before the required period, the account becomes inactive. It can be revived by paying the arrears with penalty as per the official rules.</p>
<h3>Which scheme gives higher returns, APY or NPS?</h3>
<p>NPS has the potential for higher returns because of equity exposure, but returns are not guaranteed. APY provides a guaranteed pension at maturity.</p>
HTML,
        'faqs' => [
            ['question' => 'Can I have both APY and NPS accounts?', 'answer' => 'Yes, both schemes can be held together. The pension from APY and NPS are separate, and both provide tax benefits.'],
            ['question' => 'What happens if I stop paying APY contributions?', 'answer' => 'If contributions stop before the required period, the account becomes inactive. It can be revived by paying the arrears with penalty as per the official rules.'],
            ['question' => 'Which scheme gives higher returns, APY or NPS?', 'answer' => 'NPS has the potential for higher returns because of equity exposure, but returns are not guaranteed. APY provides a guaranteed pension at maturity.'],
        ],
    ],
    [
        'title' => 'PM Awas Yojana Beneficiary List 2026: How to Check Status Online',
        'slug' => 'pm-awas-yojana-beneficiary-list-check-2026',
        'excerpt' => 'Check your name in the PM Awas Yojana beneficiary list online. Step-by-step guide for the 2026 list, state-wise PDFs and application status.',
        'meta_title' => 'PM Awas Yojana Beneficiary List 2026: Check Status Online',
        'meta_description' => 'Check PM Awas Yojana beneficiary list 2026 online. Find your name in state-wise PDFs and track your application status step by step.',
        'focus_keyword' => 'PM Awas Yojana beneficiary list 2026',
        'content' => <<<'HTML'
<h2>What Is PM Awas Yojana?</h2>
<p>Pradhan Mantri Awas Yojana (PMAY) aims to provide affordable housing to all eligible families. The scheme runs in two streams: PMAY-Gramin for rural areas and PMAY-Urban for cities, with financial assistance for building or buying a house.</p>

<h2>How to Check the Beneficiary List 2026</h2>
<p>The beneficiary list is published on the official PMAY portals and on state housing department websites. Follow these steps:</p>
<ol>
<li>Visit the official PMAY-Gramin portal (pmayg.nic.in) or the PMAY-Urban portal.</li>
<li>Select your state, district, block, and village or city from the dropdowns.</li>
<li>Click on the beneficiary list or Awas+ report section.</li>
<li>Download the PDF and search for your name or Aadhaar number.</li>
</ol>

<h2>What If My Name Is Not in the List?</h2>
<p>If your name is missing, your application may still be under verification, or you may not meet the current eligibility criteria. You can check your application status with the application number, and appeal through the state grievance portal if you believe you were wrongly excluded.</p>

<h2>Documents Needed for the Application</h2>
<ul>
<li>Aadhaar card of all family members.</li>
<li>Bank account details for the subsidy transfer.</li>
<li>Land documents or proof of the plot.</li>
<li>Income certificate for verification.</li>
</ul>

<h2>Frequently Asked Questions</h2>
<h3>How much subsidy does PMAY provide?</h3>
<p>Subsidy amounts vary by category and location, from a few lakh rupees under PMAY-Urban to fixed assistance under PMAY-Gramin. The exact figures are as per the official portal.</p>
<h3>Can I check the beneficiary list with my Aadhaar number?</h3>
<p>Yes, the PMAY portals allow searching the beneficiary list using Aadhaar or the application number.</p>
<h3>How do I correct a mistake in my PMAY application?</h3>
<p>Contact the state nodal agency or the local panchayat/municipal office to correct details, or use the grievance option on the PMAY portal.</p>
HTML,
        'faqs' => [
            ['question' => 'How much subsidy does PMAY provide?', 'answer' => 'Subsidy amounts vary by category and location, from a few lakh rupees under PMAY-Urban to fixed assistance under PMAY-Gramin. The exact figures are as per the official portal.'],
            ['question' => 'Can I check the beneficiary list with my Aadhaar number?', 'answer' => 'Yes, the PMAY portals allow searching the beneficiary list using Aadhaar or the application number.'],
            ['question' => 'How do I correct a mistake in my PMAY application?', 'answer' => 'Contact the state nodal agency or the local panchayat/municipal office to correct details, or use the grievance option on the PMAY portal.'],
        ],
    ],
    [
        'title' => 'PM Mudra Yojana: Loan Amount, Eligibility & Interest Rate 2026',
        'slug' => 'pm-mudra-yojana-loan-guide-2026',
        'excerpt' => 'PM Mudra Yojana provides loans up to Rs 10 lakh for small businesses. Check eligibility, interest rates, and how to apply under Shishu, Kishor and Tarun categories.',
        'meta_title' => 'PM Mudra Yojana: Loan Amount, Eligibility & Interest 2026',
        'meta_description' => 'PM Mudra Yojana offers loans up to Rs 10 lakh for small businesses. Check 2026 eligibility, categories, interest rates and application process.',
        'focus_keyword' => 'PM Mudra Yojana loan',
        'content' => <<<'HTML'
<h2>What Is PM Mudra Yojana?</h2>
<p>Pradhan Mantri Mudra Yojana provides collateral-free loans up to Rs 10 lakh to small businesses, shops, and self-employment ventures. The loans are extended by banks, microfinance institutions, and NBFCs under the Mudra umbrella.</p>

<h2>Mudra Loan Categories</h2>
<ul>
<li><strong>Shishu:</strong> Loans up to Rs 50,000 for new businesses.</li>
<li><strong>Kishor:</strong> Loans from Rs 50,000 to Rs 5 lakh for growing businesses.</li>
<li><strong>Tarun:</strong> Loans from Rs 5 lakh to Rs 10 lakh for established enterprises.</li>
</ul>

<h2>Eligibility Criteria</h2>
<ul>
<li>Any Indian citizen running a non-farm income generating activity.</li>
<li>Small manufacturing units, traders, service providers, and shop owners.</li>
<li>No collateral or guarantee required for loans up to Rs 10 lakh.</li>
<li>Business should be at least 6 months old for higher category loans in most banks.</li>
</ul>

<h2>Documents Required</h2>
<ol>
<li>KYC documents: Aadhaar, PAN card.</li>
<li>Business proof: shop establishment certificate, trade licence, or GST registration.</li>
<li>Bank statement of the last 6 months.</li>
<li>Project proposal or loan application form.</li>
</ol>

<h2>How to Apply for a Mudra Loan</h2>
<p>Apply online through the Udyami Mitra portal or directly at any bank branch. The bank evaluates your business plan and credit history before sanctioning the loan. Interest rates are set by individual banks as per RBI guidelines.</p>

<h2>Frequently Asked Questions</h2>
<h3>Can women entrepreneurs get Mudra loans?</h3>
<p>Yes, Mudra loans are available to all, and a large share of Mudra loans is disbursed to women entrepreneurs every year.</p>
<h3>Is a Mudra loan collateral-free?</h3>
<p>Yes, loans up to Rs 10 lakh under Mudra do not require collateral or a third-party guarantee.</p>
<h3>How long does Mudra loan approval take?</h3>
<p>Approval usually takes 1-4 weeks depending on the bank and the completeness of your documents and business plan.</p>
HTML,
        'faqs' => [
            ['question' => 'Can women entrepreneurs get Mudra loans?', 'answer' => 'Yes, Mudra loans are available to all, and a large share of Mudra loans is disbursed to women entrepreneurs every year.'],
            ['question' => 'Is a Mudra loan collateral-free?', 'answer' => 'Yes, loans up to Rs 10 lakh under Mudra do not require collateral or a third-party guarantee.'],
            ['question' => 'How long does Mudra loan approval take?', 'answer' => 'Approval usually takes 1-4 weeks depending on the bank and the completeness of your documents and business plan.'],
        ],
    ],
    [
        'title' => 'PM Jan Dhan Yojana: Zero Balance Account Benefits & How to Open',
        'slug' => 'pm-jan-dhan-yojana-zero-balance-account-guide',
        'excerpt' => 'PM Jan Dhan Yojana offers zero balance accounts with free insurance. Learn how to open a PMJDY account and what benefits you get in 2026.',
        'meta_title' => 'PM Jan Dhan Yojana: Zero Balance Account Benefits 2026',
        'meta_description' => 'Open a PM Jan Dhan Yojana zero balance account. Check benefits like free insurance, overdraft facility and the complete account opening process.',
        'focus_keyword' => 'PM Jan Dhan Yojana zero balance account',
        'content' => <<<'HTML'
<h2>What Is PM Jan Dhan Yojana?</h2>
<p>Pradhan Mantri Jan Dhan Yojana (PMJDY) is a financial inclusion scheme that provides every household a bank account with zero minimum balance. Accounts come with a RuPay debit card, accident insurance cover, and access to credit facilities.</p>

<h2>Benefits of a PMJDY Account</h2>
<ul>
<li>Zero balance account with no minimum balance requirement.</li>
<li>Free RuPay debit card with accident insurance cover as per official terms.</li>
<li>Overdraft facility of up to Rs 10,000 after satisfactory operation of the account.</li>
<li>Direct benefit transfer of subsidies and government payments.</li>
<li>Access to mobile banking and other financial services.</li>
</ul>

<h2>How to Open a PMJDY Account</h2>
<ol>
<li>Visit any bank branch or approach a banking correspondent in your village.</li>
<li>Fill the PMJDY account opening form.</li>
<li>Submit your Aadhaar card and a passport-size photograph.</li>
<li>Complete eKYC through the bank official.</li>
<li>Receive your passbook and RuPay card on the spot in most cases.</li>
</ol>

<h2>Documents Required</h2>
<p>Aadhaar is sufficient for opening a PMJDY account. If you do not have Aadhaar, you can use voter ID, driving licence, or a certificate from the local authority along with a photograph.</p>

<h2>Frequently Asked Questions</h2>
<h3>Can I get a PMJDY account if I already have a bank account?</h3>
<p>PMJDY is designed for households without banking access. If you already have an account, you may not be eligible for a new PMJDY account in the same family.</p>
<h3>Is the RuPay card from PMJDY free?</h3>
<p>Yes, the RuPay debit card issued under PMJDY is free of charge for the account holder.</p>
<h3>What is the overdraft limit in PMJDY?</h3>
<p>The overdraft facility is up to Rs 10,000, available after the account has been operated satisfactorily for a period as per bank rules.</p>
HTML,
        'faqs' => [
            ['question' => 'Can I get a PMJDY account if I already have a bank account?', 'answer' => 'PMJDY is designed for households without banking access. If you already have an account, you may not be eligible for a new PMJDY account in the same family.'],
            ['question' => 'Is the RuPay card from PMJDY free?', 'answer' => 'Yes, the RuPay debit card issued under PMJDY is free of charge for the account holder.'],
            ['question' => 'What is the overdraft limit in PMJDY?', 'answer' => 'The overdraft facility is up to Rs 10,000, available after the account has been operated satisfactorily for a period as per bank rules.'],
        ],
    ],
    [
        'title' => 'PMFBY Crop Insurance: How to File a Claim Online 2026',
        'slug' => 'pmfby-crop-insurance-claim-guide-2026',
        'excerpt' => 'PM Fasal Bima Yojana protects farmers against crop loss. Learn how to file a PMFBY claim online, check claim status and know the 2026 rules.',
        'meta_title' => 'PMFBY Crop Insurance: File Claim Online & Check Status 2026',
        'meta_description' => 'File a PMFBY crop insurance claim online in 2026. Learn the claim process, documents, and how to check your claim status after crop loss.',
        'focus_keyword' => 'PMFBY crop insurance claim',
        'content' => <<<'HTML'
<h2>What Is PMFBY?</h2>
<p>Pradhan Mantri Fasal Bima Yojana (PMFBY) provides crop insurance against natural calamities, pests, and diseases. Farmers pay a small premium and the government subsidises the rest, protecting farmers from income loss due to crop damage.</p>

<h2>When Can You File a Claim?</h2>
<p>Claims can be filed when crop loss crosses the threshold due to notified reasons such as drought, flood, hailstorm, cyclone, pests, or disease. The insurance company assesses the loss through crop cutting experiments and pays the sum insured.</p>

<h2>How to File a PMFBY Claim Online</h2>
<ol>
<li>Report the crop loss to the local agriculture officer or through the PMFBY portal within the notified timeline.</li>
<li>Use the official PMFBY web portal or the crop insurance mobile app.</li>
<li>Enter your policy details and the affected crop and area.</li>
<li>Upload the required documents, including the intimation of loss.</li>
<li>Track your claim status on the portal using the claim ID.</li>
</ol>

<h2>Documents Needed for Claim</h2>
<ul>
<li>Crop insurance policy number.</li>
<li>Land records and sowing details.</li>
<li>Intimation of loss report.</li>
<li>Bank account details for the claim amount.</li>
</ul>

<h2>Frequently Asked Questions</h2>
<h3>How much premium do farmers pay under PMFBY?</h3>
<p>Farmers pay a nominal premium, with the balance subsidised by the government. The exact premium rates are notified each season as per the official portal.</p>
<h3>What is the deadline for reporting crop loss?</h3>
<p>The loss must be reported within the notified period after the calamity, usually within 72 hours, through the portal, app, or the local agriculture department.</p>
<h3>How long does PMFBY claim settlement take?</h3>
<p>Settlement is completed after the crop cutting experiments and assessment, typically within a few months of the season end.</p>
HTML,
        'faqs' => [
            ['question' => 'How much premium do farmers pay under PMFBY?', 'answer' => 'Farmers pay a nominal premium, with the balance subsidised by the government. The exact premium rates are notified each season as per the official portal.'],
            ['question' => 'What is the deadline for reporting crop loss?', 'answer' => 'The loss must be reported within the notified period after the calamity, usually within 72 hours, through the portal, app, or the local agriculture department.'],
            ['question' => 'How long does PMFBY claim settlement take?', 'answer' => 'Settlement is completed after the crop cutting experiments and assessment, typically within a few months of the season end.'],
        ],
    ],
    [
        'title' => 'Sukanya Samriddhi Yojana: How to Open Account & Interest Rate 2026',
        'slug' => 'sukanya-samriddhi-account-open-guide-2026',
        'excerpt' => 'Open a Sukanya Samriddhi Yojana account for your girl child. Check 2026 interest rate, deposit limits, documents and the complete account opening process.',
        'meta_title' => 'Sukanya Samriddhi Yojana: Open Account & Interest Rate 2026',
        'meta_description' => 'Sukanya Samriddhi Yojana account opening guide for 2026. Check interest rate, deposit limit, documents and eligibility for your girl child.',
        'focus_keyword' => 'Sukanya Samriddhi Yojana account opening',
        'content' => <<<'HTML'
<h2>What Is Sukanya Samriddhi Yojana?</h2>
<p>Sukanya Samriddhi Yojana (SSY) is a small savings scheme for the girl child, launched under Beti Bachao Beti Padhao. The account can be opened in the name of a girl child up to 10 years of age, with attractive interest rates and tax benefits.</p>

<h2>Eligibility and Rules</h2>
<ul>
<li>The account can be opened for a girl child up to 10 years of age.</li>
<li>Only one account per girl child, and a maximum of two accounts per family.</li>
<li>Minimum deposit of Rs 250 and maximum of Rs 1.5 lakh per financial year.</li>
<li>The account matures 21 years from the date of opening or on marriage of the girl child after 18 years.</li>
</ul>

<h2>How to Open an SSY Account</h2>
<ol>
<li>Visit a post office or any authorised bank branch.</li>
<li>Fill the SSY account opening form in the name of the girl child.</li>
<li>Submit the birth certificate of the girl child and KYC of the parent or guardian.</li>
<li>Make the initial deposit and receive the passbook.</li>
</ol>

<h2>Interest Rate and Tax Benefits</h2>
<p>The SSY interest rate is notified quarterly by the government and is among the highest in small savings schemes. Deposits qualify for deduction under Section 80C, and the interest and maturity amount are tax-free as per current rules.</p>

<h2>Frequently Asked Questions</h2>
<h3>Can I open more than one SSY account for two daughters?</h3>
<p>Yes, one account per girl child is allowed, up to two accounts per family.</p>
<h3>What happens if I miss an SSY deposit for a year?</h3>
<p>The account can be revived by paying the minimum deposit with a penalty as per the official rules.</p>
<h3>Can the SSY account be closed before maturity?</h3>
<p>Premature closure is allowed only in specified cases such as the marriage of the girl child after she turns 18, or medical emergencies as per official rules.</p>
HTML,
        'faqs' => [
            ['question' => 'Can I open more than one SSY account for two daughters?', 'answer' => 'Yes, one account per girl child is allowed, up to two accounts per family.'],
            ['question' => 'What happens if I miss an SSY deposit for a year?', 'answer' => 'The account can be revived by paying the minimum deposit with a penalty as per the official rules.'],
            ['question' => 'Can the SSY account be closed before maturity?', 'answer' => 'Premature closure is allowed only in specified cases such as the marriage of the girl child after she turns 18, or medical emergencies as per official rules.'],
        ],
    ],
    [
        'title' => 'PM-KUSUM Solar Pump Scheme: Subsidy, Eligibility & How to Apply',
        'slug' => 'pm-kusum-solar-pump-scheme-2026',
        'excerpt' => 'PM-KUSUM scheme helps farmers install solar pumps with big subsidies. Check 2026 eligibility, subsidy share, and the online application process.',
        'meta_title' => 'PM-KUSUM Solar Pump Scheme: Subsidy & Apply 2026',
        'meta_description' => 'PM-KUSUM scheme offers subsidised solar pumps to farmers. Check 2026 eligibility, subsidy percentage, and how to apply online for solar pumps.',
        'focus_keyword' => 'PM-KUSUM solar pump scheme',
        'content' => <<<'HTML'
<h2>What Is PM-KUSUM?</h2>
<p>Pradhan Mantri Kisan Urja Suraksha evam Utthaan Mahabhiyan (PM-KUSUM) promotes solar energy in agriculture. The scheme supports farmers to install solar pumps and solar power plants on their land, reducing dependence on diesel and grid power.</p>

<h2>Components of the Scheme</h2>
<ul>
<li><strong>Component A:</strong> Small solar power plants of up to 2 MW on barren or agricultural land.</li>
<li><strong>Component B:</strong> Standalone solar agriculture pumps of up to 7.5 HP.</li>
<li><strong>Component C:</strong> Solarisation of existing grid-connected agriculture pumps.</li>
</ul>

<h2>Subsidy Details</h2>
<p>The central government provides a subsidy on the benchmark cost of the solar pump, with the state government and the farmer sharing the balance. The exact subsidy percentage varies by state and pump capacity, as per the official portal.</p>

<h2>Eligibility Criteria</h2>
<ul>
<li>The applicant must be a farmer with agricultural land.</li>
<li>Land records must be in the farmer's name or supported by valid cultivation documents.</li>
<li>For solarising grid pumps, an existing agriculture connection is required.</li>
<li>Group applications from farmer producer organisations are also allowed.</li>
</ul>

<h2>How to Apply</h2>
<p>Apply through your state's renewable energy department or the national portal of the Ministry of New and Renewable Energy. The state nodal agency verifies the application, and after approval, the subsidy is adjusted against the pump cost.</p>

<h2>Frequently Asked Questions</h2>
<h3>How much does a PM-KUSUM solar pump cost after subsidy?</h3>
<p>The farmer's share depends on the pump capacity and state subsidy. Check your state's renewable energy department for the exact out-of-pocket cost.</p>
<h3>Can tenant farmers apply for PM-KUSUM?</h3>
<p>Yes, farmers with valid cultivation rights, including tenants, can apply with the required land documents.</p>
<h3>How long does PM-KUSUM approval take?</h3>
<p>The timeline varies by state and the availability of funds, typically a few months from application to installation.</p>
HTML,
        'faqs' => [
            ['question' => 'How much does a PM-KUSUM solar pump cost after subsidy?', 'answer' => "The farmer's share depends on the pump capacity and state subsidy. Check your state's renewable energy department for the exact out-of-pocket cost."],
            ['question' => 'Can tenant farmers apply for PM-KUSUM?', 'answer' => 'Yes, farmers with valid cultivation rights, including tenants, can apply with the required land documents.'],
            ['question' => 'How long does PM-KUSUM approval take?', 'answer' => 'The timeline varies by state and the availability of funds, typically a few months from application to installation.'],
        ],
    ],
];

$created = 0;
$skipped = 0;
foreach ($articles as $data) {
    if (Article::where('slug', $data['slug'])->exists()) {
        $row = Article::where('slug', $data['slug'])->first();
        if (!$row->faqs) {
            $row->update(['faqs' => $data['faqs']]);
            echo "FAQSFILLED: {$data['slug']}\n";
        } else {
            echo "SKIP (exists): {$data['slug']}\n";
        }
        $skipped++;
        continue;
    }
    Article::create(array_merge($data, [
        'status' => 'published',
        'published_at' => now(),
        'view_count' => 0,
    ]));
    echo "CREATED: {$data['title']}\n";
    $created++;
}
echo "DONE: created=$created skipped=$skipped\n";
