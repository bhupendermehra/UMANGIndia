<?php

namespace Database\Seeders;

use App\Models\Scheme;
use Illuminate\Database\Seeder;

class ExpandTopSchemes extends Seeder
{
    public function run(): void
    {
        // PM Kisan Samman Nidhi
        Scheme::updateOrCreate(['slug' => 'pm-kisan-samman-nidhi'], [
            'content' => '<h2>Pradhan Mantri Kisan Samman Nidhi (PM-KISAN) – Complete Guide</h2>
<p>Pradhan Mantri Kisan Samman Nidhi (PM-KISAN) is a flagship central sector scheme launched by the Government of India on 24 February 2019. The scheme is administered by the Ministry of Agriculture and Farmers Welfare. It provides direct income support of ₹6,000 per year to small and marginal landholding farmer families across the country. The amount is transferred in three equal installments of ₹2,000 each directly into the bank accounts of eligible farmers through the Direct Benefit Transfer (DBT) system.</p>

<h3>Eligibility Criteria</h3>
<ul>
<li>All landholding farmer families with cultivable land in their name are eligible.</li>
<li>Farmers from all states and union territories can apply.</li>
<li>The scheme covers both male and female farmers equally.</li>
<li>Families with land up to 2 hectares (5 acres) are given priority, but there is no strict upper land limit.</li>
<li>Farmers belonging to all categories – SC, ST, OBC, and General – are eligible.</li>
</ul>

<h3>Who is NOT Eligible?</h3>
<ul>
<li>Institutional landholders (trusts, temples, gurudwaras, etc.) cannot apply.</li>
<li>Current and former constitutional office holders (President, Vice President, Prime Minister, Chief Justice, etc.) are excluded.</li>
<li>Current and former Members of Parliament and Members of Legislative Assembly are excluded.</li>
<li>Current and former Chairpersons of Municipal Corporations, Zila Parishads, etc. are excluded.</li>
<li>All serving and retired officers and employees of Central/State Government as well as PSUs are excluded.</li>
<li>All income tax payers (anyone who filed ITR in the assessment year) are excluded.</li>
<li>Doctors, engineers, lawyers, chartered accountants, and other professionals registered with professional bodies and carrying out practice are excluded.</li>
</ul>

<h3>Benefits of PM-KISAN</h3>
<ul>
<li>₹6,000 per year income support per eligible farmer family.</li>
<li>Amount released in three installments of ₹2,000 every four months.</li>
<li>Money transferred directly to the Aadhaar-linked bank account via DBT.</li>
<li>No middlemen – full transparency in payment.</li>
<li>The scheme benefits approximately 14.5 crore farmer families nationwide.</li>
<li>Funds can be used for agricultural inputs like seeds, fertilizers, equipment, and family needs.</li>
</ul>

<h3>How to Apply for PM-KISAN – Step by Step</h3>
<ol>
<li>Visit the official PM-KISAN portal at https://pmkissan.gov.in.</li>
<li>Click on "Farmers Corner" section on the homepage.</li>
<li>Select "New Farmer Registration" option.</li>
<li>Enter your Aadhaar number and the captcha code displayed on screen.</li>
<li>Fill in all required details – name, father/husband name, date of birth, gender, mobile number, and bank account details.</li>
<li>Enter your land details – survey number, khata number, and total cultivable land area.</li>
<li>Upload scanned copies of required documents (Aadhaar card, land records, bank passbook).</li>
<li>Review all information and click "Submit".</li>
<li>After successful submission, note down the application reference number for future tracking.</li>
<li>Alternatively, visit your nearest Common Service Centre (CSC) for free registration assistance.</li>
</ol>

<h3>Required Documents</h3>
<ul>
<li>Aadhaar Card – mandatory for identity verification and DBT transfer.</li>
<li>Land Records – copy of 7/12 extract, Khatauni, or any official land document showing cultivable land ownership.</li>
<li>Bank Account Details – bank passbook or cancelled cheque showing account number and IFSC code.</li>
<li>Mobile Number – registered mobile number for SMS alerts and OTP verification.</li>
<li>Passport Size Photograph – recent photograph for application form.</li>
</ul>

<h3>Frequently Asked Questions</h3>
<p><strong>Q1. Can a farmer with more than 2 hectares of land apply?</strong><br>Yes, there is no strict upper land limit. The scheme was originally for small and marginal farmers (up to 2 hectares), but the government has removed this restriction. All landholding farmer families are eligible.</p>
<p><strong>Q2. How can I check my PM-KISAN payment status?</strong><br>Visit https://pmkissan.gov.in, go to "Farmers Corner", click on "Beneficiary Status", enter your Aadhaar number or account number, and click "Get Data".</p>
<p><strong>Q3. My payment was not received. What should I do?</strong><br>First check your beneficiary status on the PM-KISAN portal. If your name is not in the list, contact your local agriculture officer or visit the nearest CSC. Common reasons for non-payment include wrong bank account details, Aadhaar not linked to bank, or name not in land records.</p>
<p><strong>Q4. Is PM-KISAN available for tenant farmers?</strong><br>Tenant farmers and sharecroppers are not currently covered under the scheme unless they have formal land ownership documents in their name. Some states have started including tenant farmers through state-specific initiatives.</p>
<p><strong>Q5. Can I update my bank account details after registration?</strong><br>Yes, you can update your bank details on the PM-KISAN portal. Go to "Farmers Corner" → "Edit Farmer Details" and enter your Aadhaar number to make changes.</p>',
            'content_hi' => '<h2>प्रधानमंत्री किसान सम्मान निधि (पीएम-किसान) – पूरी जानकारी</h2>
<p>प्रधानमंत्री किसान सम्मान निधि (पीएम-किसान) भारत सरकार की एक प्रमुख केंद्रीय क्षेत्र की योजना है जिसे 24 फरवरी 2019 को शुरू किया गया। यह योजना कृषि और किसान कल्याण मंत्रालय द्वारा संचालित है। इसके तहत छोटे और सीमांत भूमि धारक किसान परिवारों को प्रति वर्ष ₹6,000 की सीधी आय सहायता प्रदान की जाती है। यह राशि तीन समान किश्तों में ₹2,000 प्रति किश्त के हिसाब से सीधे लाभार्थियों के बैंक खातों में डीबीटी के माध्यम से हस्तांतरित की जाती है।</p>
<h3>पात्रता मानदंड</h3>
<ul><li>अपने नाम पर कृषि योग्य भूमि वाले सभी भूमि धारक किसान परिवार पात्र हैं।</li><li>सभी राज्यों और केंद्र शासित प्रदेशों के किसान आवेदन कर सकते हैं।</li><li>पुरुष और महिला किसान दोनों समान रूप से पात्र हैं।</li><li>2 हेक्टेयर तक भूमि वाले परिवारों को प्राथमिकता दी जाती है।</li></ul>
<h3>लाभ</h3>
<ul><li>प्रति वर्ष ₹6,000 की आय सहायता।</li><li>तीन किश्तों में ₹2,000 प्रति किश्त।</li><li>राशि सीधे आधार से जुड़े बैंक खाते में डीबीटी द्वारा हस्तांतरित।</li></ul>
<h3>आवेदन प्रक्रिया</h3>
<ol><li>आधिकारिक पोर्टल https://pmkissan.gov.in पर जाएं।</li><li>"किसान कोना" पर क्लिक करें।</li><li>"नया पंजीकरण" चुनें।</li><li>आधार नंबर और कैप्चा दर्ज करें।</li><li>सभी आवश्यक जानकारी भरें।</li><li>भूमि विवरण दर्ज करें।</li><li>दस्तावेज अपलोड करें और जमा करें।</li></ol>',
            'eligibility' => '<p><strong>All landholding farmer families</strong> with cultivable land in their name are eligible for PM-KISAN.</p><p><strong>Excluded categories:</strong> Income tax payers, current/former MPs/MLAs, constitutional office holders, all government employees (serving and retired), PSU employees, and professionals like doctors, engineers, lawyers, and CAs registered with professional bodies.</p><p><strong>Land requirement:</strong> No strict upper land limit. The scheme was originally for small and marginal farmers but has been extended to all landholding farmers.</p>',
            'benefits' => '₹6,000 per year income support released in 3 equal installments of ₹2,000 every 4 months. Payment is made directly to the Aadhaar-linked bank account via DBT. No middlemen involved. Approximately 14.5 crore farmers benefit nationwide.',
            'application_process' => "1. Visit https://pmkissan.gov.in\n2. Click on 'Farmers Corner'\n3. Select 'New Farmer Registration'\n4. Enter Aadhaar number and captcha\n5. Fill personal details (name, mobile, bank account)\n6. Enter land details (survey number, khata number)\n7. Upload documents (Aadhaar, land records, bank passbook)\n8. Submit and note the application reference number",
            'required_documents' => 'Aadhaar card (mandatory), Land records (7/12 extract or Khatauni), Bank passbook or cancelled cheque, Registered mobile number, Passport size photograph',
            'meta_title' => 'PM Kisan Samman Nidhi 2026: ₹6,000 Apply Online, Eligibility & Status Check',
            'meta_description' => 'PM Kisan Samman Nidhi provides ₹6,000/year to farmers. Check eligibility, apply online, track payment status at pmkissan.gov.in. Complete guide 2026.',
            'meta_keywords' => 'PM Kisan, PM Kisan 2026, Kisan Samman Nidhi, ₹6000 kisan, pmkissan.gov.in, farmer scheme',
            'title_hi' => 'पीएम किसान सम्मान निधि',
            'short_description_hi' => 'किसानों को ₹6,000 प्रति वर्ष की आय सहायता। ऑनलाइन आवेदन करें और भुगतान की स्थिति जांचें।',
            'eligibility_hi' => 'अपने नाम पर कृषि योग्य भूमि वाले सभी किसान परिवार पात्र हैं। आयकर दाता, सरकारी कर्मचारी, सांसद/विधायक पात्र नहीं हैं।',
            'benefits_hi' => 'प्रति वर्ष ₹6,000 की आय सहायता तीन किश्तों में ₹2,000 प्रति किश्त। राशि सीधे बैंक खाते में डीबीटी द्वारा हस्तांतरित।',
            'application_process_hi' => "1. https://pmkissan.gov.in पर जाएं\n2. 'किसान कोना' पर क्लिक करें\n3. 'नया पंजीकरण' चुनें\n4. आधार नंबर दर्ज करें\n5. व्यक्तिगत जानकारी भरें\n6. भूमि विवरण दर्ज करें\n7. दस्तावेज अपलोड करें\n8. आवेदन जमा करें",
            'required_documents_hi' => 'आधार कार्ड, भूमि दस्तावेज (7/12 उतारा), बैंक पासबुक, पंजीकृत मोबाइल नंबर',
            'meta_title_hi' => 'पीएम किसान योजना 2026: ₹6,000 ऑनलाइन आवेदन, पात्रता और स्थिति जांच',
            'meta_description_hi' => 'पीएम किसान सम्मान निधि किसानों को ₹6,000/वर्ष प्रदान करती है। पात्रता जांचें, ऑनलाइन आवेदन करें, भुगतान की स्थिति देखें।',
        ]);

        // Ayushman Bharat PM-JAY
        Scheme::updateOrCreate(['slug' => 'ayushman-bharat-pmjay'], [
            'content' => '<h2>Ayushman Bharat Pradhan Mantri Jan Arogya Yojana (AB-PMJAY) – Complete Guide</h2>
<p>Ayushman Bharat Pradhan Mantri Jan Arogya Yojana (AB-PMJAY) is the world\'s largest government-funded healthcare scheme, launched on 23 September 2018 by the Government of India. It is administered by the National Health Authority (NHA). The scheme provides a health coverage of ₹5 lakh per family per year for secondary and tertiary care hospitalization. It benefits over 55 crore beneficiaries (approximately 12 crore families) belonging to the bottom 40% of India\'s population, based on the Socio-Economic Caste Census (SECC) 2011 database.</p>

<h3>Eligibility Criteria</h3>
<ul>
<li>Families identified in the SECC 2011 database as deprived rural families and specific occupational categories.</li>
<li>Rural families falling under one of the seven deprivation criteria (D1 to D7).</li>
<li>Urban families with 11 defined occupational categories (rag pickers, beggars, domestic workers, etc.).</li>
<li>No age restriction – all family members from newborn to elderly are covered.</li>
<li>The scheme is portable across India – beneficiaries can avail treatment in any empaneled hospital in any state.</li>
</ul>

<h3>Benefits of Ayushman Bharat</h3>
<ul>
<li>Health insurance cover of ₹5 lakh per family per year.</li>
<li>Covers up to 3 days of pre-hospitalization and 15 days of post-hospitalization expenses.</li>
<li>Over 1,950 medical procedures covered including surgeries, medical treatments, and diagnostics.</li>
<li>Cashless and paperless treatment at any empaneled public or private hospital.</li>
<li>No cap on family size – all family members are covered.</li>
<li>Pre-existing diseases are covered from day one.</li>
<li>Transport allowance of up to ₹1,000 per hospitalization (subject to a maximum of ₹5,000 per family per year).</li>
</ul>

<h3>How to Apply for Ayushman Bharat Card</h3>
<ol>
<li>Check your eligibility by visiting https://mera.pmjay.gov.in.</li>
<li>Enter your mobile number or search by name, district, or ration card number.</li>
<li>If eligible, download your e-card (Ayushman card) from the website.</li>
<li>Visit the nearest Common Service Centre (CSC) to get a physical card made.</li>
<li>The card is free of cost – do not pay anyone for it.</li>
<li>To avail treatment, show your Ayushman card at any empaneled hospital and get cashless treatment.</li>
</ol>

<h3>Documents Required</h3>
<ul>
<li>Ayushman card (PM-JAY e-card) – can be downloaded from the portal.</li>
<li>Aadhaar card for identity verification.</li>
<li>SECC 2011 ration card or any document proving eligibility.</li>
<li>Mobile number registered with the scheme.</li>
</ul>

<h3>Frequently Asked Questions</h3>
<p><strong>Q1. How much does Ayushman Bharat cover per family?</strong><br>₹5 lakh per family per year for secondary and tertiary care hospitalization. This is a floater sum – if one member uses ₹3 lakh, the remaining ₹2 lakh is available for other family members.</p>
<p><strong>Q2. Are pre-existing diseases covered?</strong><br>Yes, pre-existing diseases are covered from day one of the scheme. There is no waiting period.</p>
<p><strong>Q3. Can I get treatment in any hospital?</strong><br>Yes, you can get treatment at any public or private hospital empaneled under PM-JAY anywhere in India. The scheme is fully portable.</p>
<p><strong>Q4. How do I know if I am eligible?</strong><br>Check your eligibility at https://mera.pmjay.gov.in by entering your mobile number or searching by name and location.</p>
<p><strong>Q5. What is not covered under the scheme?</strong><br>Outpatient (OPD) treatment, dental procedures (unless requiring hospitalization), and certain cosmetic surgeries are not covered. The scheme focuses on inpatient hospitalization requiring more than 24 hours of stay.</p>',
            'content_hi' => '<h2>आयुष्मान भारत प्रधानमंत्री जन आरोग्य योजना – पूरी जानकारी</h2>
<p>आयुष्मान भारत प्रधानमंत्री जन आरोग्य योजना (AB-PMJAY) दुनिया की सबसे बड़ी सरकारी स्वास्थ्य बीमा योजना है। इसे 23 सितंबर 2018 को शुरू किया गया। इस योजना के तहत प्रति परिवार प्रति वर्ष ₹5 लाख तक का स्वास्थ्य कवर प्रदान किया जाता है।</p>',
            'eligibility' => 'Families identified in SECC 2011 database. Rural families under deprivation criteria (D1-D7). Urban families in 11 occupational categories like rag pickers, beggars, domestic workers, etc. No age restriction. Portable across all Indian states.',
            'benefits' => '₹5 lakh health cover per family per year. Over 1,950 procedures covered. Cashless treatment at empaneled hospitals. Pre-existing diseases covered from day one. Transport allowance up to ₹1,000 per hospitalization.',
            'application_process' => "1. Visit https://mera.pmjay.gov.in\n2. Check eligibility using mobile number or name\n3. Download Ayushman e-card\n4. Visit CSC for physical card\n5. Show card at empaneled hospital for cashless treatment",
            'required_documents' => 'Ayushman e-card, Aadhaar card, SECC 2011 ration card, Registered mobile number',
            'meta_title' => 'Ayushman Bharat 2026: ₹5 Lakh Health Cover, Card Apply, Eligibility Check',
            'meta_description' => 'Ayushman Bharat PM-JAY provides ₹5 lakh health insurance per family. Check eligibility, download card, find empaneled hospitals. Complete guide 2026.',
            'meta_keywords' => 'Ayushman Bharat, PMJAY, PM Jan Arogya Yojana, Ayushman card, ₹5 lakh health cover, health insurance',
            'title_hi' => 'आयुष्मान भारत पीएम-जेएवाई',
            'short_description_hi' => '₹5 लाख का स्वास्थ्य बीमा कवर। पात्रता जांचें और आयुष्मान कार्ड डाउनलोड करें।',
            'eligibility_hi' => 'SECC 2011 डेटाबेस में शामिल परिवार। ग्रामीण वंचित परिवार (D1-D7) और शहरी 11 श्रेणियां। कोई आयु सीमा नहीं। पूरे भारत में लागू।',
            'benefits_hi' => 'प्रति परिवार ₹5 लाख स्वास्थ्य कवर। 1,950 से अधिक उपचार शामिल। पहले से मौजूद बीमारियां कवर।',
            'application_process_hi' => "1. https://mera.pmjay.gov.in पर जाएं\n2. मोबाइल नंबर से पात्रता जांचें\n3. आयुष्मान ई-कार्ड डाउनलोड करें\n4. सीएससी से कार्ड बनवाएं\n5. अस्पताल में कार्ड दिखाकर इलाज कराएं",
            'required_documents_hi' => 'आयुष्मान ई-कार्ड, आधार कार्ड, राशन कार्ड, पंजीकृत मोबाइल नंबर',
        ]);

        $this->command->info('Expanded PM Kisan and Ayushman Bharat schemes with detailed content.');
        $this->command->warn('Run this seeder multiple times to add more schemes. Currently expanded: 2 of 20 planned.');
    }
}
