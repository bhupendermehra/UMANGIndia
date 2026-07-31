-- ============================================================
-- Batch 3: Replace thin content body for articles 15-24
-- These had excerpts + FAQs added but content body was NOT replaced
-- ============================================================

-- #15 PM SVANidhi
UPDATE articles SET content = '<h2>Introduction</h2>
<p>PM Street Vendor''s AtmaNirbhar Nidhi (PM SVANidhi) was launched in June 2020 to provide affordable working capital loans to street vendors whose livelihoods were impacted by the COVID-19 pandemic. As of 2026, over 65 lakh vendors have received loans totalling more than ₹8,500 crore. The scheme helps vendors restart their businesses and build a credit history for future formal loans.</p>

<h2>Loan Structure</h2>
<table><tr><th>Loan Tranche</th><th>Amount</th><th>Interest Subsidy</th><th>Tenure</th></tr>
<tr><td>First Loan</td><td>₹10,000</td><td>7% interest subsidy (effective rate ~0%)</td><td>12 months</td></tr>
<tr><td>Second Loan (after timely repayment)</td><td>₹20,000</td><td>7% interest subsidy</td><td>18 months</td></tr>
<tr><td>Third Loan (after timely repayment)</td><td>₹50,000</td><td>7% interest subsidy</td><td>24 months</td></tr></table>

<h2>Digital Transaction Incentive</h2>
<p>Street vendors who accept digital payments receive a monthly cashback of ₹100 for up to 100 transactions per month. This encourages adoption of UPI, debit cards, and mobile wallets among the street vendor community.</p>

<h2>Frequently Asked Questions</h2>
<h3>Who is eligible for PM SVANidhi?</h3>
<p>Street vendors engaged in vending on or before March 24, 2020, in urban areas are eligible. The vendor must possess a Certificate of Vending issued by the Urban Local Body or have a valid identity proof showing vending activity. Family members of deceased vendors are also eligible.</p>
<h3>How do I apply for this scheme?</h3>
<p>Visit the PM SVANidhi portal (pmsvanidhi.mohua.gov.in) or approach your nearest bank branch. You need your vending certificate or identification, Aadhaar card, bank account details, and mobile number. The loan is processed within 15 working days.</p>
<h3>What happens if I default on repayment?</h3>
<p>Timely repayment is essential to qualify for higher loan tranches (₹20,000 and ₹50,000). Defaulters are not eligible for subsequent loans. The 7% interest subsidy is calculated on timely repayment — delayed payments may forfeit the subsidy benefit.</p>
<h3>Can I prepay the loan?</h3>
<p>Yes, there is no prepayment penalty. Early repayment helps you become eligible for the next higher loan tranche sooner. The interest subsidy is calculated on the outstanding amount and credited quarterly.</p>
<h3>What documents are needed for renewal?</h3>
<p>For second and third loans, you need proof of timely repayment of the previous loan, continued vending activity proof, updated Aadhaar, and a bank statement showing digital transaction history (for the incentive).</p>' WHERE id = 15;

-- #16 Atal Pension Yojana
UPDATE articles SET content = '<h2>Introduction</h2>
<p>Atal Pension Yojana (APY), launched in May 2015 by the Government of India, is a universal pension scheme focused on the unorganised sector. The scheme guarantees a minimum monthly pension of ₹1,000 to ₹5,000 from age 60, depending on the contribution amount chosen by the subscriber. As of 2026, over 6 crore subscribers have enrolled in APY, making it India''s largest guaranteed pension scheme.</p>

<h2>Pension Options and Monthly Contribution</h2>
<table><tr><th>Entry Age</th><th>₹1,000/m Pension</th><th>₹5,000/m Pension</th></tr>
<tr><td>18 years</td><td>₹42 per month</td><td>₹210 per month</td></tr>
<tr><td>25 years</td><td>₹76 per month</td><td>₹376 per month</td></tr>
<tr><td>30 years</td><td>₹116 per month</td><td>₹577 per month</td></tr>
<tr><td>35 years</td><td>₹182 per month</td><td>₹906 per month</td></tr>
<tr><td>40 years</td><td>₹291 per month</td><td>₹1,454 per month</td></tr></table>

<h2>Government Co-Contribution</h2>
<p>Subscribers who are not income tax payers and join between the ages of 18-40 years receive a government co-contribution of 50% of their own contribution or ₹1,000 per year, whichever is lower, for the first 5 years. This benefit is available to those who enrolled before March 31, 2022, with eligible ongoing subscribers continuing to receive it.</p>

<h2>Frequently Asked Questions</h2>
<h3>What is the minimum and maximum pension I can get?","answer":"You can choose any monthly pension amount between ₹1,000 and ₹5,000 in multiples of ₹1,000. The contribution amount varies based on your chosen pension and entry age. The younger you start, the lower your monthly contribution.</p>
<h3>What happens to my spouse after my death?</h3>
<p>After the subscriber''s death, the spouse receives the same pension amount. After both the subscriber and spouse pass away, the accumulated corpus is returned to the nominee. This spousal continuation ensures family pension security.</p>
<h3>Can I exit the scheme before 60?","answer":"If you exit before 60, you receive only your contributed amount plus accrued interest. However, if you exit within the first 5 years, only your contribution is returned without interest — the government co-contribution (if applicable) is forfeited. Exit is permitted only under exceptional circumstances.</p>
<h3>Can I continue APY after 60?","answer":"After age 60, you stop contributing and start receiving the guaranteed monthly pension for life. The pension is paid through your bank or post office account. You can continue APY contributions even if you secure formal employment.</p>
<h3>Is APY available to all citizens?","answer":"Any Indian citizen between 18 and 40 years of age can open an APY account. The scheme is particularly beneficial for unorganised sector workers who do not have access to formal pension schemes. A savings bank account is mandatory for enrollment.</p>' WHERE id = 16;

-- #17 Digital India
UPDATE articles SET content = '<h2>Introduction</h2>
<p>Digital India is a flagship programme of the Government of India launched on July 1, 2015, with a vision to transform India into a digitally empowered society and knowledge economy. The programme is implemented by the Ministry of Electronics and Information Technology (MeitY) and covers over 50+ digital initiatives spanning broadband connectivity, digital identity, e-governance, and digital literacy. As of 2026, India''s internet user base has crossed 950 million, driven largely by Digital India initiatives.</p>

<h2>Key Initiatives Under Digital India</h2>
<table><tr><th>Initiative</th><th>Purpose</th><th>Reach/Impact (2026)</th></tr>
<tr><td>Aadhaar</td><td>Digital identity for every resident</td><td>138 crore+ Aadhaar issued</td></tr>
<tr><td>DigiLocker</td><td>Cloud-based document storage</td><td>20 crore+ registered users</td></tr>
<tr><td>UMANG App</td><td>Single app for 1,200+ government services</td><td>5 crore+ downloads</td></tr>
<tr><td>BharatNet</td><td>Broadband to 2.5 lakh gram panchayats</td><td>1.8 lakh connected</td></tr>
<tr><td>Common Service Centres (CSC)</td><td>Digital access points in villages</td><td>5 lakh+ CSCs</td></tr></table>

<h2>Frequently Asked Questions</h2>
<h3>What is the UMANG app and how does it work?</h3>
<p>UMANG (Unified Mobile Application for New-Age Governance) provides access to over 1,200 government services through a single mobile app. Services include EPFO, NPS, Passport Seva, Aadhaar, Income Tax, and state government services in multiple Indian languages. Download from Google Play or Apple App Store, register with your mobile number, and access services using your existing credentials.</p>
<h3>How does DigiLocker benefit citizens?","answer":"DigiLocker eliminates the need to carry physical documents. You can store Aadhaar, driving license, vehicle registration, mark sheets, and other certificates in your DigiLocker account. Documents issued through DigiLocker are legally valid under the Information Technology Act, 2000. Over 5,000+ government organizations issue documents digitally through DigiLocker.</p>
<h3>What is the impact of Aadhaar on government services?","answer":"Aadhaar has enabled Direct Benefit Transfer (DBT) saving over ₹2.7 lakh crore by eliminating duplicate and fake beneficiaries. It provides a unique digital identity for each resident and enables e-KYC verification without physical documents. Over 1,000+ government schemes use Aadhaar for beneficiary authentication.</p>
<h3>How can I get digital literacy training?","answer":"The PM Gramin Digital Saksharta Abhiyan (PMGDISHA) provides free digital literacy training to rural households. Over 6 crore rural citizens have been trained to operate computers, use the internet, access government portals, and conduct digital transactions. Visit your nearest CSC to register.</p>
<h3>What is the Common Service Centre scheme?","answer":"CSCs are physical access points for government services in rural areas. Over 5 lakh CSCs across India provide digital services including Aadhaar enrollment, bill payments, insurance, banking, and government form filing. CSCs have created 12+ lakh rural employment opportunities.</p>' WHERE id = 17;

-- #18 PM Awas Urban
UPDATE articles SET content = '<h2>Introduction</h2>
<p>Pradhan Mantri Awas Yojana – Urban (PMAY-U) was launched in June 2015 to provide affordable housing to urban poor households. The scheme has four verticals: In-Situ Slum Redevelopment, Credit Linked Subsidy Scheme (CLSS), Affordable Housing in Partnership, and Subsidy for Beneficiary-Led Construction. As of 2026, over 1.2 crore houses have been sanctioned under PMAY-U with an investment of over ₹8 lakh crore.</p>

<h2>CLSS Interest Subsidy Details</h2>
<table><tr><th>Income Category</th><th>Annual Income Limit</th><th>Interest Subsidy</th><th>Max Loan Eligible</th></tr>
<tr><td>EWS</td><td>Up to ₹3,00,000</td><td>6.5% subsidy on 9% rate (effective ~3.33%)</td><td>₹6,00,000</td></tr>
<tr><td>LIG</td><td>₹3,00,001 – ₹6,00,000</td><td>6.5% subsidy (effective ~3.33%)</td><td>₹6,00,000</td></tr>
<tr><td>MIG-I</td><td>₹6,00,001 – ₹12,00,000</td><td>4% subsidy (effective ~5.33%)</td><td>₹9,00,000</td></tr>
<tr><td>MIG-II</td><td>₹12,00,001 – ₹18,00,000</td><td>3% subsidy (effective ~6.33%)</td><td>₹12,00,000</td></tr></table>

<h2>Frequently Asked Questions</h2>
<h3>How is the PMAY Urban subsidy calculated?","answer":"The subsidy is calculated on the interest rate reduction, not the loan principal. For example, EWS/LIG beneficiaries get a 6.5% interest subsidy on a 9% loan, bringing their effective rate to approximately 3.33%. The net present value of this interest subsidy is up to ₹2.67 lakh, which is credited upfront to the loan account.</p>
<h3>Can I apply for PMAY Urban if I already have a house?","answer":"No, PMAY Urban is only for families who do not own a pucca house anywhere in India. The beneficiary family should not have availed housing assistance from any central or state government housing scheme earlier. Self-declaration of houselessness is accepted.</p>
<h3>What is the minimum carpet area for PMAY houses?","answer":"For EWS category, the minimum carpet area is 30 sq meters. For LIG category, it is 60 sq meters. For MIG-I and MIG-II, it is 160 sq meters. The house must have at least one room, kitchen-cum-living area, and a hygienic toilet.</p>
<h3>How do I apply for PMAY Urban 2026?","answer":"Apply online through the PMAY Urban portal (pmay-urban.gov.in) or visit your nearest bank or Urban Local Body office. You need Aadhaar, income certificate, and proof of residence. The application is verified by the ULB and the subsidy is released through your lending bank.</p>' WHERE id = 18;

-- #19 PM Awas Gramin
UPDATE articles SET content = '<h2>Introduction</h2>
<p>Pradhan Mantri Awas Yojana – Gramin (PMAY-G) aims to provide pucca houses with basic amenities to all rural households who are houseless or living in dilapidated houses. Launched in November 2016, the scheme replaced the earlier Indira Awas Yojana. As of 2026, over 3.2 crore houses have been completed under PMAY-G with a total investment exceeding ₹2.5 lakh crore. The scheme is jointly funded by the central and state governments in a 60:40 ratio (90:10 for Himalayan states).</p>

<h2>Financial Assistance Structure</h2>
<table><tr><th>Location</th><th>Central Share</th><th>State Share</th><th>Total Assistance</th></tr>
<tr><td>Plain Areas</td><td>₹72,000</td><td>₹48,000</td><td>₹1,20,000</td></tr>
<tr><td>Hilly/Difficult Areas</td><td>₹78,000</td><td>₹52,000</td><td>₹1,30,000</td></tr></table>

<h2>Convergence with Swachh Bharat</h2>
<p>PMAY-G beneficiaries also receive assistance of ₹12,000 for construction of a toilet under Swachh Bharat Mission-Gramin (SBM-G). Additionally, 90 person-days of unskilled labour under MGNREGA are provided to supplement the construction cost, and convergence with PM Ujjwala Yojana provides a free LPG connection.</p>

<h2>Frequently Asked Questions</h2>
<h3>How are beneficiaries selected for PMAY Gramin?","answer":"Beneficiaries are selected using the SECC 2011 database based on housing deprivation parameters. The selection prioritizes SC/ST households, households with no adult member aged 16-59, landless families, and families living in kutcha, dilapidated, or zero-room houses. The Gram Sabha validates the final list.</p>
<h3>What is the timeline for house construction?","answer":"The house must be completed within 12 months of sanction. The assistance is released in three installments based on construction progress. The first 40% is released at foundation stage, 40% at lintel level, and the final 20% after completion and plastering. Extensions are granted in exceptional circumstances.</p>
<h3>Can a woman be the sole owner of the PMAY house?","answer":"Yes, PMAY-G mandates that the house must be registered in the name of the female head of the household, or jointly with the male head. This empowers women with property rights in rural India. Where there is no adult woman, the house can be registered in the name of any adult male member.</p>
<h3>Can I take a top-up loan for a larger house?","answer":"Yes, beneficiaries can avail a top-up loan of up to ₹70,000 under the PMAY-G scheme from banks for constructing a larger house (minimum 25 sq meters). The top-up loan is available at 4% interest rate with a repayment period of up to 10 years.</p>
<h3>What if I already own land?","answer":"If you own land, you can construct a PMAY-G house on your existing plot. Landless beneficiaries are provided land by the state government under various land distribution schemes, or they can purchase land using the PMAY-G assistance along with their own contribution.</p>' WHERE id = 19;

-- #20 Top Education Schemes
UPDATE articles SET content = '<h2>Introduction</h2>
<p>India offers over 50 education scholarship schemes through the National Scholarship Portal (NSP) and various state government portals. These schemes cover students from Class 1 to PhD level, with benefits ranging from ₹5,000 to full tuition coverage plus living expenses. This guide covers the top 10 most beneficial education schemes in India for 2026, their eligibility criteria, and application deadlines.</p>

<h2>Top 10 Education Schemes Comparison</h2>
<table><tr><th>Scheme Name</th><th>Benefit Amount</th><th>Eligibility</th><th>Income Limit</th></tr>
<tr><td>National Means-cum-Merit Scholarship</td><td>₹12,000 per year</td><td>Class 9-12, 55% marks</td><td>₹3.5 lakh</td></tr>
<tr><td>Central Sector Scheme for Top Class Education</td><td>Full tuition + ₹3,000/m stipend</td><td>SC/ST students in top institutions</td><td>₹2.5 lakh</td></tr>
<tr><td>Post-Matric Scholarship for SC/ST</td><td>Full fees + ₹1,200-₹3,000/m</td><td>SC/ST students in Class 11-PhD</td><td>₹2.5 lakh (SC)</td></tr>
<tr><td>Begum Hazrat Mahal Scholarship</td><td>₹12,000 per year</td><td>Minority community girls</td><td>₹2 lakh</td></tr>
<tr><td>Prime Minister''s Scholarship Scheme</td><td>₹20,000-₹25,000 per year</td><td>Defence/Paramilitary wards</td><td>No limit</td></tr></table>

<h2>Frequently Asked Questions</h2>
<h3>How do I apply for education scholarships in India?","answer":"Most central scholarships are applied through the National Scholarship Portal (scholarships.gov.in). State-specific scholarships have separate portals. Applications typically open from August to November each year. You need Aadhaar, bank account (preferably Jan Dhan), income certificate, and previous year''s mark sheet.</p>
<h3>What is the income limit for central scholarships?","answer":"Most central scholarships have an annual family income limit between ₹2 lakh and ₹4.5 lakh. Pre-matric schemes typically have a ₹2 lakh limit, while post-matric and merit-based schemes go up to ₹4.5 lakh. Some schemes like the Prime Minister''s Scholarship Scheme have no income limit.</p>
<h3>Can OBC students get scholarships?","answer":"Yes, OBC students are eligible for the Dr. Ambedkar Post-Matric Scholarship for OBC Students which covers tuition fees, maintenance allowance (₹1,200/month hosteller, ₹550/month day scholar), and book grant. The annual income limit is ₹3 lakh. Applications are accepted through the NSP portal.</p>
<h3>How much is the National Means-cum-Merit Scholarship?","answer":"The NMMSS provides ₹12,000 per year (₹1,000 per month) to meritorious students from economically weaker families studying in Class 9 to 12. Selected in Class 8 through a state-level exam, the scholarship continues until Class 12 if the student maintains 55% marks. A total of 1 lakh scholarships are awarded annually.</p>
<h3>What is the Begum Hazrat Mahal Scholarship?","answer":"This scholarship for meritorious girl students from minority communities (Muslim, Christian, Sikh, Buddhist, Jain, Parsi) provides ₹12,000 per year for Class 9-10 and ₹15,000 per year for Class 11-12. The annual family income limit is ₹2 lakh. Applications are accepted through the Maulana Azad Education Foundation portal.</p>' WHERE id = 20;

-- #21 Health Insurance Schemes
UPDATE articles SET content = '<h2>Introduction</h2>
<p>India has one of the world''s largest government-funded health insurance ecosystems, covering over 70 crore beneficiaries across central and state schemes. From Ayushman Bharat PMJAY providing ₹5 lakh cover to state-specific schemes like Swasthya Sathi (West Bengal), Arogyasri (Andhra Pradesh), and Mukhyamantri Amrutam (Gujarat), this guide provides a complete comparison of all major health insurance schemes available in India for 2026.</p>

<h2>Major Health Insurance Schemes Compared</h2>
<table><tr><th>Scheme Name</th><th>Coverage Amount</th><th>Beneficiaries</th><th>Premium/Contribution</th></tr>
<tr><td>Ayushman Bharat PMJAY</td><td>₹5 lakh per family/year</td><td>10.74 crore families</td><td>Free (government-funded)</td></tr>
<tr><td>CGHS</td><td>Unlimited OPD + IPD</td><td>40+ lakh central govt employees</td><td>₹500-₹5,000/month (employee share)</td></tr>
<tr><td>ESI Scheme</td><td>Medical + cash benefits</td><td>13+ crore workers/families</td><td>0.75% employee + 3.25% employer</td></tr>
<tr><td>Swasthya Sathi (WB)</td><td>₹5 lakh per family/year</td><td>7+ crore WB residents</td><td>Free for BPL; ₹900/year for APL</td></tr>
<tr><td>Dr. YSR Arogyasri (AP)</td><td>₹5 lakh per family/year</td><td>1.5+ crore AP families</td><td>Free (state-funded)</td></tr></table>

<h2>Frequently Asked Questions</h2>
<h3>Which is the largest health insurance scheme in India?","answer":"Ayushman Bharat PMJAY is the world''s largest government-funded healthcare program, covering over 10.74 crore poor and vulnerable families with a health cover of ₹5 lakh per family per year. It has 25,000+ empanelled hospitals and covers 1,600+ medical procedures across all states except Delhi and West Bengal.</p>
<h3>Does ESI cover maternity benefits?","answer":"Yes, ESI provides maternity benefit of 100% of daily wages for 26 weeks (12 weeks in case of miscarriage). The benefit also covers prenatal and postnatal medical care. In addition, ESI provides maternity leave, nursing breaks, and crèche facilities at workplaces with 20+ women employees.</p>
<h3>What is the difference between CGHS and Ayushman Bharat?","answer":"CGHS is exclusively for central government employees and pensioners, offering comprehensive OPD and IPD coverage at designated CGHS hospitals and dispensaries. Ayushman Bharat is for BPL families with coverage limited to inpatient care at empanelled hospitals. CGHS has an employee contribution while PMJAY is fully government-funded.</p>
<h3>Can foreigners avail Ayushman Bharat?","answer":"No, Ayushman Bharat is specifically for Indian citizens identified through the SECC 2011 database. Foreign nationals are not eligible. However, OCI/PIO cardholders who are Indian residents and meet the SECC criteria may be eligible if their families are enumerated in the database.</p>
<h3>What is the process to claim cashless treatment?","answer":"Visit any empanelled hospital with your Ayushman card (e-card or physical) and Aadhaar. The hospital checks eligibility online, submits a pre-authorization request, and after approval (within 8 hours for normal cases, 1 hour for emergencies), provides cashless treatment. You do not pay anything at the hospital.</p>' WHERE id = 21;

-- #22 Agriculture Schemes
UPDATE articles SET content = '<h2>Introduction</h2>
<p>The Government of India runs over 25 major agriculture schemes covering income support, crop insurance, irrigation, market access, and soil health. Key programs include PM Kisan Samman Nidhi (₹6,000/year income support), PM Kisan Maandhan (₹3,000/month pension), Kisan Credit Card (crop loans at 4%), PM Fasal Bima Yojana (crop insurance at 1.5-5% premium), Soil Health Card Scheme, and PM Kisan Urja Suraksha (solar pumps). This guide compares all central agriculture schemes with their benefits and eligibility.</p>

<h2>Major Agriculture Schemes Comparison</h2>
<table><tr><th>Scheme Name</th><th>Type</th><th>Financial Benefit</th><th>Target Beneficiaries</th></tr>
<tr><td>PM Kisan Samman Nidhi</td><td>Income support</td><td>₹6,000/year in 3 installments</td><td>Small & marginal farmers (≤2 hectares)</td></tr>
<tr><td>PM Kisan Maandhan</td><td>Pension</td><td>₹3,000/month after age 60</td><td>Farmers aged 18-40 years</td></tr>
<tr><td>Kisan Credit Card</td><td>Credit/loan</td><td>₹3 lakh loan at 4% interest</td><td>All farmers</td></tr>
<tr><td>PM Fasal Bima Yojana</td><td>Crop insurance</td><td>Crop loss coverage (2% kharif, 1.5% rabi)</td><td>All farmers (mandatory for loanee farmers)</td></tr>
<tr><td>Soil Health Card Scheme</td><td>Advisory</td><td>Free soil testing every 2 years</td><td>All farmers</td></tr></table>

<h2>Frequently Asked Questions</h2>
<h3>How many installments does PM Kisan have?","answer":"PM Kisan provides ₹6,000 per year in three equal installments of ₹2,000 each. The first installment is released between April-July, the second between August-November, and the third between December-March. The amount is directly credited to the Aadhaar-linked bank account through DBT.</p>
<h3>What is the premium for PM Fasal Bima Yojana?","answer":"Farmers pay a nominal premium of 2% of the sum insured for kharif crops, 1.5% for rabi crops, and 5% for commercial and horticultural crops. The remaining premium is subsidized equally by the central and state governments. The scheme covers yield loss, prevented sowing, and post-harvest losses.</p>
<h3>How much loan can I get through KCC?","answer":"Kisan Credit Card provides short-term crop loans up to ₹3 lakh per farmer at a 4% interest rate. The KCC also covers working capital for farm maintenance, post-harvest expenses, and investment credit for farm machinery. The card is valid for 5 years with an annual review of the credit limit.</p>
<h3>What is the Soil Health Card benefit?","answer":"The Soil Health Card Scheme provides farmers with a detailed report of their soil''s nutrient status every 2 years. Based on the report, farmers receive customized fertilizer recommendations, reducing input costs by 8-10% and increasing yield by 5-7%. Over 25 crore soil health cards have been distributed.</p>
<h3>What is PM Kisan Urja Suraksha?","answer":"PM-KUSUM provides solar pumps and grid-connected solar plants to farmers. Farmers get 60% central subsidy, 30% state subsidy, and pay only 10% for installing standalone solar pumps. The scheme reduces electricity bills and provides an additional income stream through surplus power sale to the grid.</p>' WHERE id = 22;

-- #23 Women Welfare Schemes
UPDATE articles SET content = '<h2>Introduction</h2>
<p>The Government of India and various state governments run over 30 women-focused welfare schemes covering financial assistance, health, education, entrepreneurship, and safety. This guide covers the most impactful women welfare schemes including Pradhan Mantri Matru Vandana Yojana (₹5,000 maternity benefit), Ladli Laxmi Yojana (₹1,00,000 over life stages), Beti Bachao Beti Padhao, Sukanya Samriddhi Yojana (8.2% interest), PM Ujjwala Yojana (free LPG), and state-specific schemes from MP, UP, West Bengal, and other states.</p>

<h2>Major Women Welfare Schemes Comparison</h2>
<table><tr><th>Scheme Name</th><th>Category</th><th>Financial Benefit</th><th>Eligibility</th></tr>
<tr><td>PMMVY (Matru Vandana)</td><td>Maternity benefit</td><td>₹5,000 in 3 installments</td><td>Pregnant women, first child</td></tr>
<tr><td>Ladli Laxmi Yojana (MP)</td><td>Girl child</td><td>₹1,00,000 phased over 21 years</td><td>Girl child born after 2006 in BPL families</td></tr>
<tr><td>PM Ujjwala Yojana</td><td>Health/Poverty</td><td>Free LPG connection + subsidy</td><td>BPL women, SC/ST priority</td></tr>
<tr><td>Sukanya Samriddhi Yojana</td><td>Savings</td><td>8.2% interest, ₹1.5L max deposit</td><td>Girl child below 10 years</td></tr>
<tr><td>Lakshmir Bhandar (WB)</td><td>Monthly allowance</td><td>₹500-₹1,000 per month</td><td>Women aged 25-60 in West Bengal</td></tr></table>

<h2>Frequently Asked Questions</h2>
<h3>What is the PM Matru Vandana Yojana benefit?","answer":"PMMVY provides ₹5,000 to pregnant women and lactating mothers for their first living child, paid in three installments: ₹1,000 at early pregnancy registration (within 150 days), ₹2,000 at six months of pregnancy, and ₹2,000 after childbirth registration and first immunization. The total benefit of ₹5,000 is credited to the Aadhaar-linked bank account.</p>
<h3>What is the Ladli Laxmi Yojana benefit in MP?","answer":"Under Ladli Laxmi Yojana, the Madhya Pradesh government provides ₹6,000 at birth, ₹6,000 on Class 6 admission, ₹6,000 on Class 9 admission, ₹6,000 on Class 12/college admission, and ₹75,000 at age 21 (if unmarried). The total benefit over 21 years is ₹1,00,000. Eligible girls must be born after January 1, 2006, in BPL families.</p>
<h3>What is the Lakshmir Bhandar scheme in West Bengal?","answer":"Lakshmir Bhandar provides monthly financial assistance to women aged 25-60 in West Bengal. General category women receive ₹500 per month, while SC/ST women receive ₹1,000 per month. The amount is directly credited to the woman''s bank account. Over 2 crore women benefit from this scheme.</p>
<h3>What are the maternity leave benefits for working women?","answer":"The Maternity Benefit Act provides 26 weeks of paid maternity leave for women working in the organized sector. The employer pays the full salary during this period. Additionally, 12 months of crèche facilities are mandated for workplaces with 50+ employees. Nursing breaks of 30 minutes are provided twice daily.</p>
<h3>What is the One Stop Centre scheme?","answer":"One Stop Centres (OSCs), also called Sakhi Centres, provide integrated support to women affected by violence. Services include medical aid, legal assistance, police facilitation, psychological counseling, and temporary shelter. Over 700 OSCs operate across India, funded under the Nirbhaya Framework.</p>' WHERE id = 23;

-- #24 Social Welfare Schemes
UPDATE articles SET content = '<h2>Introduction</h2>
<p>India''s social welfare framework includes central schemes like the National Social Assistance Programme (NSAP), PM Garib Kalyan Anna Yojana (food security), state-specific pension schemes, disability benefits, and welfare programs for vulnerable groups. As of 2026, over 15 crore senior citizens, widows, and disabled persons receive monthly pension through various social welfare schemes. This guide provides a comprehensive comparison of all major social welfare schemes, their eligibility, benefits, and the application process.</p>

<h2>Major Social Welfare Schemes Comparison</h2>
<table><tr><th>Scheme Name</th><th>Type</th><th>Financial Benefit</th><th>Eligibility</th></tr>
<tr><td>Indira Gandhi National Old Age Pension</td><td>Pension</td><td>₹500/month (central) + state top-up</td><td>Age 60+ (65+ for higher pension), BPL</td></tr>
<tr><td>Indira Gandhi National Widow Pension</td><td>Pension</td><td>₹500/month (central) + state top-up</td><td>Widows aged 40-59, BPL</td></tr>
<tr><td>Indira Gandhi National Disability Pension</td><td>Pension</td><td>₹500/month (central) + state top-up</td><td>Disabled 18-79 years, 80%+ disability, BPL</td></tr>
<tr><td>PM Garib Kalyan Anna Yojana</td><td>Food security</td><td>5 kg food grains/person/month free</td><td>NFSA ration card holders (additional quota)</td></tr>
<tr><td>National Family Benefit Scheme</td><td>Death assistance</td><td>₹20,000 one-time</td><td>Primary breadwinner death aged 18-64</td></tr></table>

<h2>Frequently Asked Questions</h2>
<h3>What is the total pension amount I can get from NSAP?","answer":"The central government provides ₹500 per month under each NSAP component (old age, widow, disability). However, many states add a top-up — for example, Delhi gives ₹2,000, Haryana ₹1,500, Tamil Nadu ₹1,200. The total combines central + state amounts. Check your state''s social welfare department for exact combined figures.</p>
<h3>Who qualifies for the old age pension under NSAP?","answer":"Individuals aged 60 years and above (65+ for the higher ₹500 rate) belonging to Below Poverty Line (BPL) families qualify. Those already receiving other government pensions are not eligible. Application is made through the local SDM office or state social welfare portal with age proof, BPL certificate, and bank account details.</p>
<h3>What is PM Garib Kalyan Anna Yojana 2026?","answer":"PMGKAY was initially launched as a COVID-19 relief measure providing free food grains. As of 2026, certain states have extended the scheme or merged it with NFSA. Eligible ration card holders receive 5 kg of rice/wheat per person per month plus 1 kg chana per family. This is in addition to the regular NFSA quota.</p>
<h3>What is the disability pension benefit?","answer":"The Indira Gandhi National Disability Pension provides ₹500 per month to persons with 80% or more disability aged 18-79 years from BPL families. Some states provide additional amounts. The beneficiary must have a disability certificate from a government medical board. The pension is paid through DBT to the bank account.</p>
<h3>How is the National Family Benefit Scheme different from pension?","answer":"NFBS provides a one-time lumpsum assistance of ₹20,000 to BPL families in case of the primary breadwinner''s death (aged 18-64). Unlike regular pension schemes, this is a one-time benefit. Apply through the Gram Panchayat or block office with death certificate, BPL card, and a family declaration form within 6 months of the death.</p>' WHERE id = 24;
