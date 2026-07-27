<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CreateArticles extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'title' => 'PM Kisan 2026: Complete Guide to ₹6,000 Annual Benefit – Apply Online, Check Status',
                'title_hi' => 'पीएम किसान 2026: ₹6,000 वार्षिक लाभ की पूरी जानकारी – ऑनलाइन आवेदन और स्थिति जांच',
                'slug' => 'pm-kisan-2026-complete-guide',
                'content' => '<h2>Introduction</h2>
<p>Pradhan Mantri Kisan Samman Nidhi (PM-KISAN) is one of the most important government schemes for Indian farmers. Launched in February 2019, the scheme provides direct income support of ₹6,000 per year to landholding farmer families. In 2026, the scheme continues to be the backbone of farmer welfare in India.</p>

<h2>What is PM Kisan Samman Nidhi?</h2>
<p>PM-KISAN is a Central Sector Scheme under which eligible farmer families receive ₹6,000 per year in three equal installments of ₹2,000 each. The money is transferred directly to the Aadhaar-linked bank accounts of beneficiaries through the Direct Benefit Transfer (DBT) system. This eliminates middlemen and ensures that every rupee reaches the farmer.</p>

<h2>Eligibility Criteria for 2026</h2>
<p>To avail the benefits of PM-KISAN in 2026, farmers must meet the following criteria:</p>
<ul>
<li>The applicant must be a landholding farmer with cultivable land in their name.</li>
<li>The scheme covers all categories of farmers – SC, ST, OBC, and General.</li>
<li>Both male and female farmers are equally eligible.</li>
<li>There is no strict upper limit on landholding size.</li>
</ul>
<p>The following categories are NOT eligible:</p>
<ul>
<li>Income tax payers (anyone who filed ITR).</li>
<li>Current and former MPs, MLAs, MLCs.</li>
<li>All government employees (serving and retired).</li>
<li>PSU employees and pensioners.</li>
<li>Institutional landholders.</li>
</ul>

<h2>Benefits Under PM-KISAN</h2>
<ul>
<li>₹6,000 per year per eligible farmer family.</li>
<li>Three installments of ₹2,000 each in April, August, and December.</li>
<li>Direct transfer to bank account – no middlemen.</li>
<li>Transparent tracking through PM-KISAN portal.</li>
<li>Over 14 crore families benefit from this scheme.</li>
</ul>

<h2>How to Apply for PM Kisan 2026?</h2>
<ol>
<li>Visit the official PM-KISAN website: https://pmkissan.gov.in</li>
<li>Click on "Farmers Corner" and select "New Farmer Registration".</li>
<li>Enter your Aadhaar number and the security captcha.</li>
<li>Fill in personal details: name, father/husband name, date of birth, mobile number, and email (optional).</li>
<li>Enter bank account details: account number, IFSC code, and branch name.</li>
<li>Provide land details: survey number, khata number, and total land area.</li>
<li>Upload scanned copies of required documents.</li>
<li>Verify all information and submit the form.</li>
<li>Save the application reference number for future tracking.</li>
</ol>

<h2>How to Check PM-KISAN Payment Status?</h2>
<ol>
<li>Visit https://pmkissan.gov.in.</li>
<li>Click on "Farmers Corner" → "Beneficiary Status".</li>
<li>Enter your Aadhaar number or bank account number.</li>
<li>Click "Get Data" to view your payment status.</li>
<li>You can also check through the PM-KISAN mobile app available on Google Play Store.</li>
</ol>

<h2>Required Documents</h2>
<ul>
<li>Aadhaar Card (mandatory for identity verification).</li>
<li>Land Records: 7/12 extract, Khatauni, or any official land document.</li>
<li>Bank Account Details: passbook or cancelled cheque with IFSC code.</li>
<li>Registered Mobile Number: for OTP verification and alerts.</li>
<li>Passport Size Photograph: recent photograph for the application.</li>
</ul>

<h2>Frequently Asked Questions</h2>
<p><strong>Q. Can I apply if my land is in my wife\'s name?</strong><br>Yes, the landholding farmer family is eligible. Either spouse can apply as long as the land is owned by a family member.</p>
<p><strong>Q. What if my Aadhaar is not linked to my bank account?</strong><br>You must link your Aadhaar with your bank account before applying. Without Aadhaar-bank linking, DBT payments cannot be processed.</p>
<p><strong>Q. How can I correct my name in PM-KISAN records?</strong><br>Visit the PM-KISAN portal, go to "Farmers Corner" → "Edit Farmer Details", enter your Aadhaar number, and make the necessary corrections.</p>
<p><strong>Q. Is there any fee to apply for PM-KISAN?</strong><br>No, registration is completely free. Do not pay anyone who promises to get you registered.</p>
<p><strong>Q. How many installments have been released so far?</strong><br>As of 2026, more than 15 installments have been released. The latest installment status is available on the PM-KISAN portal.</p>

<h2>Conclusion</h2>
<p>PM-KISAN is a lifeline for millions of Indian farmers. In 2026, the scheme continues to provide crucial income support, helping farmers meet their agricultural and household needs. If you are eligible and have not yet applied, visit the PM-KISAN portal today and complete your registration.</p>',
                'content_hi' => '<h2>परिचय</h2>
<p>प्रधानमंत्री किसान सम्मान निधि (पीएम-किसान) भारतीय किसानों के लिए सबसे महत्वपूर्ण सरकारी योजनाओं में से एक है। फरवरी 2019 में शुरू की गई यह योजना भूमि धारक किसान परिवारों को ₹6,000 प्रति वर्ष की सीधी आय सहायता प्रदान करती है।</p>
<h2>पीएम किसान योजना क्या है?</h2>
<p>पीएम-किसान एक केंद्रीय क्षेत्र की योजना है जिसमें पात्र किसान परिवारों को ₹6,000 प्रति वर्ष तीन समान किश्तों में ₹2,000 प्रति किश्त के हिसाब से दिए जाते हैं।</p>',
                'excerpt' => 'Complete guide to PM Kisan Samman Nidhi 2026. Check eligibility, apply online, track payment status. ₹6,000 annual benefit for farmers.',
                'excerpt_hi' => 'पीएम किसान सम्मान निधि 2026 की पूरी जानकारी। पात्रता जांचें, ऑनलाइन आवेदन करें, भुगतान स्थिति देखें।',
                'meta_title' => 'PM Kisan 2026: ₹6,000 Apply Online, Eligibility & Status Guide',
                'meta_description' => 'PM Kisan Samman Nidhi 2026: ₹6,000 annual benefit for farmers. Check eligibility, apply online at pmkissan.gov.in, track payment status. Step-by-step guide.',
                'focus_keyword' => 'PM Kisan 2026',
            ],
            [
                'title' => 'Ayushman Bharat Card Kaise Banaye 2026: Step-by-Step Guide for Free Health Cover',
                'title_hi' => 'आयुष्मान भारत कार्ड कैसे बनाएं 2026: ₹5 लाख स्वास्थ्य कवर के लिए चरण-दर-चरण गाइड',
                'slug' => 'ayushman-bharat-card-2026-guide',
                'content' => '<h2>Introduction</h2>
<p>Ayushman Bharat Pradhan Mantri Jan Arogya Yojana (PM-JAY) provides a health cover of ₹5 lakh per family per year. In 2026, this scheme continues to be the world\'s largest government-funded healthcare program. This guide will show you exactly how to make your Ayushman Bharat card and avail cashless treatment.</p>

<h2>Who is Eligible for Ayushman Bharat?</h2>
<p>Eligibility is based on the Socio-Economic Caste Census (SECC) 2011 data. The following categories are eligible:</p>
<ul>
<li>Rural families falling under deprivation criteria D1 to D7.</li>
<li>Urban families engaged in 11 identified occupational categories including rag picking, domestic work, street vending, etc.</li>
<li>No age restrictions – all family members are covered.</li>
</ul>

<h2>How to Check Eligibility Online?</h2>
<ol>
<li>Visit https://mera.pmjay.gov.in.</li>
<li>Click on "Am I Eligible?" option.</li>
<li>Enter your mobile number or ration card number.</li>
<li>If eligible, you will see your family details and can download the e-card.</li>
</ol>

<h2>How to Make Ayushman Card 2026?</h2>
<ol>
<li>Visit the official PM-JAY website: https://pmjay.gov.in.</li>
<li>Click on "Download Ayushman Card".</li>
<li>Enter your SECC or ration card number.</li>
<li>Verify with OTP sent to your registered mobile number.</li>
<li>Download the e-card in PDF format.</li>
<li>Print the card or save it on your phone for treatment.</li>
<li>Alternatively, visit any Common Service Centre (CSC) near you to get a physical card made.</li>
</ol>

<h2>Benefits of Ayushman Bharat Card</h2>
<ul>
<li>₹5 lakh health cover per family per year.</li>
<li>Cashless treatment at over 25,000 empaneled hospitals across India.</li>
<li>Over 1,950 medical procedures covered including surgeries and medical treatments.</li>
<li>Pre-existing diseases covered from day one.</li>
<li>Transport allowance up to ₹1,000 per hospitalization.</li>
<li>Portable across India – get treatment in any state.</li>
</ul>

<h2>How to Use Ayushman Card for Treatment?</h2>
<ol>
<li>Visit any Ayushman Bharat empaneled hospital.</li>
<li>Show your Ayushman card or e-card at the hospital counter.</li>
<li>The hospital checks your eligibility through the PM-JAY portal.</li>
<li>Once verified, you receive cashless treatment.</li>
<li>The hospital submits the claim to the government directly.</li>
<li>You do not pay anything for covered procedures.</li>
</ol>

<h2>Frequently Asked Questions</h2>
<p><strong>Q. Is Ayushman Bharat card free?</strong><br>Yes, the card is completely free. Do not pay anyone to make your card.</p>
<p><strong>Q. Can I get treatment in a private hospital?</strong><br>Yes, any public or private hospital empaneled under PM-JAY provides cashless treatment.</p>
<p><strong>Q. What documents are needed for the card?</strong><br>Aadhaar card and SECC ration card are the main documents needed for verification.</p>
<p><strong>Q. Does the card expire?</strong><br>The e-card does not expire as long as the scheme continues. However, you should keep your details updated.</p>
<p><strong>Q. Can NRIs apply for Ayushman Bharat?</strong><br>No, the scheme is only for Indian residents identified in the SECC 2011 database.</p>

<h2>Conclusion</h2>
<p>If you are eligible, making an Ayushman Bharat card is simple and free. This card can save you and your family from huge medical expenses. Check your eligibility today at mera.pmjay.gov.in and get your card made at the nearest CSC.</p>',
                'content_hi' => '<h2>परिचय</h2>
<p>आयुष्मान भारत प्रधानमंत्री जन आरोग्य योजना (PM-JAY) प्रति परिवार ₹5 लाख तक का स्वास्थ्य कवर प्रदान करती है। यह मार्गदर्शिका आपको बताएगी कि आयुष्मान भारत कार्ड कैसे बनाएं।</p>',
                'excerpt' => 'Learn how to make Ayushman Bharat card 2026. Step-by-step process for ₹5 lakh free health cover. Check eligibility, download e-card, find hospitals.',
                'excerpt_hi' => 'आयुष्मान भारत कार्ड बनाने का तरीका 2026। ₹5 लाख स्वास्थ्य कवर के लिए चरण-दर-चरण प्रक्रिया।',
                'meta_title' => 'Ayushman Bharat Card Kaise Banaye 2026: Step-by-Step Guide',
                'meta_description' => 'Ayushman Bharat card kaise banaye 2026? Complete step-by-step guide. Check eligibility at mera.pmjay.gov.in, download e-card, get ₹5 lakh free health cover.',
                'focus_keyword' => 'Ayushman Bharat card kaise banaye',
            ],
            [
                'title' => 'MGNREGA 2026: How to Apply for Job Card, Get 100 Days Work & Check Payment',
                'title_hi' => 'मनरेगा 2026: जॉब कार्ड के लिए आवेदन, 100 दिन का काम और भुगतान जांचने का तरीका',
                'slug' => 'mgnrega-2026-apply-job-card-guide',
                'content' => '<h2>Introduction</h2>
<p>Mahatma Gandhi National Rural Employment Guarantee Act (MGNREGA) is a landmark Indian labour law and social security measure. Launched in 2005, the scheme guarantees 100 days of wage employment per year to every rural household. As of 2026, MGNREGA continues to be the largest work guarantee programme in the world, providing livelihood security to millions of rural families.</p>

<h2>What is MGNREGA?</h2>
<p>MGNREGA provides a legal guarantee of 100 days of employment in a financial year to adult members of any rural household who are willing to do unskilled manual work. The scheme is demand-driven – anyone who needs work can apply and the government is legally obliged to provide employment within 15 days.</p>

<h2>Eligibility Criteria</h2>
<ul>
<li>Applicant must be a resident of a rural area.</li>
<li>Any adult member (18 years or above) of a rural household can apply.</li>
<li>Both men and women are eligible.</li>
<li>There is no income or landholding limit.</li>
<li>Applicants must be willing to do unskilled manual labour.</li>
</ul>

<h2>How to Apply for MGNREGA Job Card 2026?</h2>
<ol>
<li>Visit your local Gram Panchayat office.</li>
<li>Fill out the MGNREGA job card application form (Form-1).</li>
<li>Submit the form along with required documents to the Panchayat Secretary.</li>
<li>The Gram Panchayat verifies your application within 15 days.</li>
<li>Once verified, your job card is issued free of cost.</li>
<li>The job card contains the names of all adult family members registered under the scheme.</li>
</ol>

<h2>How to Get Work Under MGNREGA?</h2>
<ol>
<li>Apply for work in writing (Form-6) to the Gram Panchayat.</li>
<li>The Gram Panchayat must provide work within 15 days of your application.</li>
<li>If work is not provided within 15 days, you are entitled to an unemployment allowance.</li>
<li>Work is provided within a 5 km radius of your village.</li>
<li>You are entitled to work for up to 100 days per year per household.</li>
</ol>

<h2>Wages and Payment</h2>
<p>MGNREGA wages are paid according to the wage rate fixed by the central government. The current wage rate varies by state, ranging from approximately ₹200 to ₹300 per day. All wages are paid through DBT to the bank account of the worker within 7 days of completing the work.</p>

<h2>How to Check MGNREGA Payment Status?</h2>
<ol>
<li>Visit the official MGNREGA website: https://nrega.nic.in.</li>
<li>Click on "Citizen" tab → "MGNREGA Payment Status".</li>
<li>Enter your job card number or bank account number.</li>
<li>Select your state and district.</li>
<li>Click "Search" to view your payment status.</li>
</ol>

<h2>Frequently Asked Questions</h2>
<p><strong>Q. Is there any fee for MGNREGA job card?</strong><br>No, the job card is issued completely free of cost.</p>
<p><strong>Q. Can I choose my work?</strong><br>Work is assigned based on the needs of the village as decided by the Gram Sabha. Common works include pond digging, road construction, tree plantation, and building check dams.</p>
<p><strong>Q. What if I don\'t get work within 15 days?</strong><br>You are entitled to unemployment allowance under the scheme. File a complaint with the Programme Officer or District Programme Coordinator.</p>
<p><strong>Q. Can women work under MGNREGA?</strong><br>Yes, women are actively encouraged to work under MGNREGA. In fact, at least 33% of the workers should be women.</p>
<p><strong>Q. How many days can I work in a year?</strong><br>Up to 100 days per rural household per financial year. In drought-affected areas, the limit may be extended to 150 days.</p>

<h2>Conclusion</h2>
<p>MGNREGA is a powerful tool for rural livelihood security. If you live in a rural area and need work, apply for your job card today at the nearest Gram Panchayat office. The scheme has transformed the lives of millions of rural families across India.</p>',
                'content_hi' => '<h2>परिचय</h2>
<p>महात्मा गांधी राष्ट्रीय ग्रामीण रोजगार गारंटी अधिनियम (मनरेगा) भारत का एक महत्वपूर्ण श्रम कानून और सामाजिक सुरक्षा उपाय है। 2005 में शुरू की गई यह योजना प्रत्येक ग्रामीण परिवार को प्रति वर्ष 100 दिन का रोजगार प्रदान करती है।</p>',
                'excerpt' => 'MGNREGA 2026 guide: Apply for job card, get 100 days work, check payment status. Complete step-by-step process for rural employment.',
                'excerpt_hi' => 'मनरेगा 2026 गाइड: जॉब कार्ड के लिए आवेदन, 100 दिन काम, भुगतान जांचने का तरीका।',
                'meta_title' => 'MGNREGA 2026: How to Apply for Job Card & Get 100 Days Work',
                'meta_description' => 'MGNREGA 2026 complete guide. Apply for job card, get 100 days work, check payment status. Eligibility, documents, step-by-step process for rural employment.',
                'focus_keyword' => 'MGNREGA 2026',
            ],
        ];

        foreach ($articles as $data) {
            Article::updateOrCreate(
                ['slug' => $data['slug']],
                array_merge($data, [
                    'status' => 'published',
                    'published_at' => now(),
                ])
            );
            $this->command->info("Article published: {$data['title']}");
        }

        $this->command->info('Created ' . count($articles) . ' new articles.');
    }
}
