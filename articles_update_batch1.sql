-- ============================================================
-- Article content expansion: unique excerpts + FAQ sections
-- Fixes AdSense "thin content" across all 37 articles
-- ============================================================

-- ==================== CRITICAL: Articles 8-14 (117-157 chars) ====================

-- #8 PM Jan Dhan Yojana 2026
UPDATE articles SET content = '<h2>Introduction</h2>
<p>Pradhan Mantri Jan Dhan Yojana (PMJDY) is India''s flagship financial inclusion program launched in August 2014. As of 2026, over 55 crore bank accounts have been opened under this scheme, bringing banking services to every unbanked household in the country. This article covers everything you need to know about opening a zero-balance account, the benefits you get, and how to apply.</p>

<h2>Key Benefits at a Glance</h2>
<table><tr><th>Feature</th><th>Details</th></tr>
<tr><td>Minimum Balance</td><td>Zero — no minimum balance required</td></tr>
<tr><td>Interest Rate</td><td>3.5% to 4% per annum on savings</td></tr>
<tr><td>Overdraft Limit</td><td>Up to ₹10,000 (after 6 months of satisfactory operation)</td></tr>
<tr><td>Insurance Cover</td><td>Accidental cover of ₹2 lakh + life cover of ₹30,000</td></tr>
<tr><td>Eligibility</td><td>Any Indian citizen above 10 years of age</td></tr></table>

<h2>Frequently Asked Questions</h2>
<h3>Can I open a Jan Dhan account without Aadhaar?</h3>
<p>Yes, you can open the account with any government-issued ID like Voter ID or Driving License. However, Aadhaar is required for RuPay card issuance and to avail the overdraft facility.</p>
<h3>How much overdraft can I get?</h3>
<p>After 6 months of satisfactory transaction history, you become eligible for an overdraft of up to ₹10,000. The overdraft is provided without any collateral.</p>
<h3>Is the Jan Dhan account free forever?</h3>
<p>Yes, there are no account maintenance charges. However, standard charges apply for cheque books, ATM transactions beyond the free limit, and other value-added services.</p>
<h3>Can I transfer my existing bank account to Jan Dhan?</h3>
<p>No, PMJDY accounts are opened as new accounts specifically under this scheme. You can hold both a regular account and a Jan Dhan account simultaneously.</p>
<h3>What happens if I don''t use the account for a long time?</h3>
<p>The account remains active as long as you complete at least one transaction every 12 months. Inactive accounts can be reactivated by visiting your bank branch.</p>', excerpt = 'Pradhan Mantri Jan Dhan Yojana provides zero-balance bank accounts with a free RuPay debit card, accidental insurance cover of ₹2 lakh, and overdraft facility up to ₹10,000. Over 55 crore Indians have been financially included through this scheme since 2014. Learn the complete process to open your account and claim all benefits.', faqs = '[{"question":"Can I open a Jan Dhan account without Aadhaar?","answer":"Yes, you can open the account with any government-issued ID like Voter ID or Driving License. However, Aadhaar is required for RuPay card issuance and to avail the overdraft facility."},{"question":"How much overdraft can I get?","answer":"After 6 months of satisfactory transaction history, you become eligible for an overdraft of up to ₹10,000. The overdraft is provided without any collateral."},{"question":"Is the Jan Dhan account free forever?","answer":"Yes, there are no account maintenance charges. However, standard charges apply for cheque books, ATM transactions beyond the free limit, and other value-added services."},{"question":"Can I hold both a Jan Dhan and regular account?","answer":"Yes, PMJDY accounts are opened as new accounts specifically under this scheme. You can hold both a regular account and a Jan Dhan account simultaneously."},{"question":"What happens if I don''t use the account for a long time?","answer":"The account remains active as long as you complete at least one transaction every 12 months. Inactive accounts can be reactivated by visiting your bank branch."}]' WHERE id = 8;

-- #9 PM Kisan Maandhan Yojana
UPDATE articles SET content = '<h2>Introduction</h2>
<p>PM Kisan Maandhan Yojana is a pension scheme specifically designed for small and marginal farmers across India. Launched in 2019 by the Ministry of Agriculture, the scheme guarantees a minimum monthly pension of ₹3,000 after the farmer reaches 60 years of age. This article explains the eligibility, contribution structure, and application process in detail.</p>

<h2>Contribution & Pension Details</h2>
<table><tr><th>Age at Entry</th><th>Monthly Contribution</th><th>Monthly Pension at 60</th></tr>
<tr><td>18 years</td><td>₹55</td><td>₹3,000</td></tr>
<tr><td>30 years</td><td>₹100</td><td>₹3,000</td></tr>
<tr><td>40 years</td><td>₹145</td><td>₹3,000</td></tr>
<tr><td>50 years</td><td>₹240</td><td>₹3,000</td></tr></table>

<h2>Frequently Asked Questions</h2>
<h3>Who is eligible for PM Kisan Maandhan?</h3>
<p>All small and marginal farmers who own up to 2 hectares of cultivable land and are between 18 to 40 years of age are eligible. The farmer must have a valid Aadhaar card and a savings bank account.</p>
<h3>How much pension will I get after 60?</h3>
<p>You will receive a guaranteed monthly pension of ₹3,000 after turning 60 years of age. The spouse is also eligible for a family pension of 50% (₹1,500) after the farmer''s death.</p>
<h3>What happens if I stop contributing?</h3>
<p>If you stop contributing before age 60, your account becomes inactive. You can resume by paying all overdue contributions with interest. After 60, you cannot restart the scheme.</p>
<h3>Is this different from PM Kisan Samman Nidhi?</h3>
<p>Yes, PM Kisan Maandhan is a pension scheme requiring monthly contributions from farmers. PM Kisan Samman Nidhi is an income support scheme giving ₹6,000 per year without any contribution from farmers.</p>', excerpt = 'PM Kisan Maandhan Yojana provides a guaranteed monthly pension of ₹3,000 to small and marginal farmers after age 60. Farmers aged 18-40 years can join with monthly contributions starting from just ₹55. Learn about the contribution table, application process, and spouse pension benefits.', faqs = '[{"question":"Who is eligible for PM Kisan Maandhan?","answer":"All small and marginal farmers who own up to 2 hectares of cultivable land and are between 18 to 40 years of age are eligible. The farmer must have a valid Aadhaar card and a savings bank account."},{"question":"How much pension will I get after 60?","answer":"You will receive a guaranteed monthly pension of ₹3,000 after turning 60 years of age. The spouse is also eligible for a family pension of 50% (₹1,500) after the farmer''s death."},{"question":"What happens if I stop contributing?","answer":"If you stop contributing before age 60, your account becomes inactive. You can resume by paying all overdue contributions with interest. After 60, you cannot restart the scheme."},{"question":"Is this different from PM Kisan Samman Nidhi?","answer":"Yes, PM Kisan Maandhan is a pension scheme requiring monthly contributions from farmers. PM Kisan Samman Nidhi is an income support scheme giving ₹6,000 per year without any contribution from farmers."}]' WHERE id = 9;

-- #10 Sukanya Samriddhi Yojana 2026
UPDATE articles SET content = '<h2>Introduction</h2>
<p>Sukanya Samriddhi Yojana (SSY) is a government-backed small savings scheme for the girl child, launched under the Beti Bachao Beti Padhao campaign. As of 2026, the scheme continues to offer one of the highest interest rates among all small savings instruments — currently 8.2% per annum compounded yearly. This article explains how parents can secure their daughter''s future with this tax-saving investment.</p>

<h2>SSY Key Details</h2>
<table><tr><th>Parameter</th><th>Details</th></tr>
<tr><td>Interest Rate (2026)</td><td>8.2% per annum (compounded yearly)</td></tr>
<tr><td>Minimum Deposit</td><td>₹250 per financial year</td></tr>
<tr><td>Maximum Deposit</td><td>₹1.5 lakh per financial year</td></tr>
<tr><td>Account Tenure</td><td>21 years from opening or until marriage after 18</td></tr>
<tr><td>Tax Benefit</td><td>Under Section 80C of Income Tax Act</td></tr></table>

<h2>Frequently Asked Questions</h2>
<h3>Who can open a Sukanya Samriddhi account?</h3>
<p>Parents or legal guardians of a girl child below 10 years of age can open the account. Only one account per girl child is allowed, and a family can open accounts for a maximum of two girl children.</p>
<h3>What documents are needed to open the account?</h3>
<p>You need the girl child''s birth certificate, Aadhaar card of the parent/guardian, proof of address, and a recent passport-size photograph. The account can be opened at any post office or authorized bank branch.</p>
<h3>Can I withdraw money before 21 years?</h3>
<p>Partial withdrawal of up to 50% of the balance is allowed after the girl child turns 18, for higher education or marriage expenses. Early closure is permitted only in exceptional cases like the girl child''s marriage or critical illness.</p>
<h3>What happens if I miss a yearly deposit?</h3>
<p>The account becomes dormant if the minimum deposit of ₹250 is not made in any financial year. You can reactivate it by paying a penalty of ₹50 per year along with the minimum deposit.</p>', excerpt = 'Sukanya Samriddhi Yojana offers 8.2% interest rate (2026) for the girl child, with deposits up to ₹1.5 lakh per year and tax benefits under Section 80C. This guide covers the account opening process, required documents, partial withdrawal rules, and how to maximize returns over the 21-year tenure.', faqs = '[{"question":"Who can open a Sukanya Samriddhi account?","answer":"Parents or legal guardians of a girl child below 10 years of age can open the account. Only one account per girl child is allowed, and a family can open accounts for a maximum of two girl children."},{"question":"What documents are needed to open the account?","answer":"You need the girl child''s birth certificate, Aadhaar card of the parent/guardian, proof of address, and a recent passport-size photograph. The account can be opened at any post office or authorized bank branch."},{"question":"Can I withdraw money before 21 years?","answer":"Partial withdrawal of up to 50% of the balance is allowed after the girl child turns 18, for higher education or marriage expenses. Early closure is permitted only in exceptional cases like the girl child''s marriage or critical illness."},{"question":"What happens if I miss a yearly deposit?","answer":"The account becomes dormant if the minimum deposit of ₹250 is not made in any financial year. You can reactivate it by paying a penalty of ₹50 per year along with the minimum deposit."}]' WHERE id = 10;

-- #11 PM Mudra Yojana 2026
UPDATE articles SET content = '<h2>Introduction</h2>
<p>Pradhan Mantri Mudra Yojana (PMMY) was launched in April 2015 to provide collateral-free loans up to ₹10 lakh to small business owners, entrepreneurs, and self-employed individuals. Under this scheme, over ₹28 lakh crore has been disbursed across more than 50 crore loan accounts since inception. This article explains the three loan categories, eligibility criteria, and step-by-step application process.</p>

<h2>Mudra Loan Categories</h2>
<table><tr><th>Category</th><th>Loan Amount</th><th>Purpose</th></tr>
<tr><td>Shishu</td><td>Up to ₹50,000</td><td>Start-up businesses, very small enterprises</td></tr>
<tr><td>Kishor</td><td>₹50,001 to ₹5 lakh</td><td>Growing businesses, working capital</td></tr>
<tr><td>Tarun</td><td>₹5,00,001 to ₹10 lakh</td><td>Established businesses, expansion</td></tr></table>

<h2>Frequently Asked Questions</h2>
<h3>Do I need collateral for a Mudra loan?</h3>
<p>No, Mudra loans are collateral-free. No third-party guarantee is required. However, banks may assess your repayment capacity and business viability before sanctioning the loan.</p>
<h3>What is the interest rate on Mudra loans?</h3>
<p>Interest rates vary by bank and loan category, typically ranging from 8% to 14% per annum. Public sector banks generally offer lower rates. Compare rates across banks before applying.</p>
<h3>How can I apply for a Mudra loan?</h3>
<p>You can apply online through the Mudra portal (mudra.org.in) or visit your nearest bank branch. You need a basic business plan, KYC documents, and bank statements for the last 6 months.</p>
<h3>Is there any subsidy on Mudra loans?</h3>
<p>Mudra loans are regular loans at market interest rates. However, women entrepreneurs and SC/ST applicants may get a 0.5% to 1% interest concession from certain banks. There is no direct subsidy on the principal amount.</p>', excerpt = 'PM Mudra Yojana provides collateral-free loans up to ₹10 lakh for small businesses under three categories: Shishu (₹50,000), Kishor (₹5 lakh), and Tarun (₹10 lakh). Over 50 crore loans have been disbursed since 2015. Learn about eligibility, interest rates, and the online application process.', faqs = '[{"question":"Do I need collateral for a Mudra loan?","answer":"No, Mudra loans are collateral-free. No third-party guarantee is required. However, banks may assess your repayment capacity and business viability before sanctioning the loan."},{"question":"What is the interest rate on Mudra loans?","answer":"Interest rates vary by bank and loan category, typically ranging from 8% to 14% per annum. Public sector banks generally offer lower rates. Compare rates across banks before applying."},{"question":"How can I apply for a Mudra loan?","answer":"You can apply online through the Mudra portal (mudra.org.in) or visit your nearest bank branch. You need a basic business plan, KYC documents, and bank statements for the last 6 months."},{"question":"Is there any subsidy on Mudra loans?","answer":"Mudra loans are regular loans at market interest rates. However, women entrepreneurs and SC/ST applicants may get a 0.5% to 1% interest concession from certain banks. There is no direct subsidy on the principal amount."}]' WHERE id = 11;

-- #12 Beti Bachao Beti Padhao 2026
UPDATE articles SET content = '<h2>Introduction</h2>
<p>Beti Bachao Beti Padhao (BBBP) is a flagship initiative of the Government of India launched in January 2015 to address the declining child sex ratio and promote education and empowerment of girl children. The scheme operates across 640+ districts with a focus on improving sex ratio at birth, ensuring girls education, and preventing gender-based discrimination. This article covers the scheme benefits and how families can participate.</p>

<h2>Scheme Impact & Focus Areas</h2>
<table><tr><th>Focus Area</th><th>Target</th><th>Achievement (2026)</th></tr>
<tr><td>Sex Ratio at Birth</td><td>Increase from 918 to 950+</td><td>934 (national average)</td></tr>
<tr><td>Girls Enrollment in Schools</td><td>100% enrollment up to Class 12</td><td>88% enrollment rate</td></tr>
<tr><td>Institutional Deliveries</td><td>100% in BBBP districts</td><td>92% achieved</td></tr></table>

<h2>Frequently Asked Questions</h2>
<h3>What is the main objective of Beti Bachao Beti Padhao?</h3>
<p>The scheme has three main objectives: preventing gender-biased sex selection, ensuring survival and protection of the girl child, and ensuring education and participation of the girl child through multi-sectoral intervention.</p>
<h3>Is there any direct cash benefit under this scheme?</h3>
<p>BBBP itself does not provide direct cash transfers. However, it works alongside schemes like Sukanya Samriddhi Yojana, Ladli Yojana state schemes, and other girl child benefit programs to provide financial incentives for girls'' education.</p>
<h3>How can I participate in the scheme?</h3>
<p>The scheme is implemented through district-level interventions. You can participate by ensuring your girl child is enrolled in school, reporting any cases of gender discrimination, and taking advantage of the various girl child savings and scholarship schemes linked to BBBP.</p>
<h3>Which government departments implement this scheme?</h3>
<p>BBBP is implemented jointly by the Ministry of Women and Child Development, Ministry of Health and Family Welfare, and Ministry of Education through a convergent approach at the district level.</p>', excerpt = 'Beti Bachao Beti Padhao (BBBP) is India''s flagship program to improve the child sex ratio and empower girl children through education. Operating in 640+ districts, the scheme has helped raise the national sex ratio from 918 to 934. Learn about its three focus areas, district-level implementation, and linked benefit schemes.', faqs = '[{"question":"What is the main objective of Beti Bachao Beti Padhao?","answer":"The scheme has three main objectives: preventing gender-biased sex selection, ensuring survival and protection of the girl child, and ensuring education and participation of the girl child through multi-sectoral intervention."},{"question":"Is there any direct cash benefit under this scheme?","answer":"BBBP itself does not provide direct cash transfers. However, it works alongside schemes like Sukanya Samriddhi Yojana, Ladli Yojana state schemes, and other girl child benefit programs to provide financial incentives for girls'' education."},{"question":"How can I participate in the scheme?","answer":"The scheme is implemented through district-level interventions. You can participate by ensuring your girl child is enrolled in school, reporting any cases of gender discrimination, and taking advantage of the various girl child savings and scholarship schemes linked to BBBP."},{"question":"Which government departments implement this scheme?","answer":"BBBP is implemented jointly by the Ministry of Women and Child Development, Ministry of Health and Family Welfare, and Ministry of Education through a convergent approach at the district level."}]' WHERE id = 12;

-- #13 PM Ujjwala Yojana 2026
UPDATE articles SET content = '<h2>Introduction</h2>
<p>Pradhan Mantri Ujjwala Yojana (PMUY) was launched in May 2016 to provide free LPG connections to women from Below Poverty Line (BPL) households. As of 2026, over 11 crore LPG connections have been released under this scheme, significantly reducing indoor air pollution and improving the health of rural women. This article explains the eligibility, documents required, and the application process in detail.</p>

<h2>PMUY Benefits at a Glance</h2>
<table><tr><th>Benefit</th><th>Details</th></tr>
<tr><td>Free LPG Connection</td><td>First LPG connection free of cost (includes cylinder, regulator, safety hose)</td></tr>
<tr><td>First Refill Subsidy</td><td>First LPG refill and stove provided free in some states</td></tr>
<tr><td>Target Beneficiaries</td><td>Women from BPL families, SC/ST, and backward classes</td></tr>
<tr><td>DBT Subsidy</td><td>Subsequent refills subsidized through Direct Benefit Transfer</td></tr></table>

<h2>Frequently Asked Questions</h2>
<h3>Who is eligible for PM Ujjwala Yojana?</h3>
<p>Women aged 18 years and above from BPL households are eligible. Priority is given to SC/ST families, households with manual scavengers, and families in backward districts. The applicant must not already have an LPG connection in the family name.</p>
<h3>What documents are needed for the application?</h3>
<p>You need a BPL ration card or BPL certificate issued by the competent authority, Aadhaar card of the applicant, bank account details (for DBT), a recent passport-size photograph, and a consent form declaring that no other family member has an LPG connection.</p>
<h3>Where can I apply for the scheme?</h3>
<p>You can apply at your nearest LPG distributor (Indian Oil, Bharat Gas, HP Gas) or through the online portal at pmujjwalayojana.com. You can also visit your local Anganwadi center or block development office for assistance.</p>
<h3>Is the LPG cylinder free under this scheme?</h3>
<p>The first LPG connection is free, but subsequent cylinder refills are not free. However, the government provides a DBT subsidy on refills. The subsidy amount varies based on market rates and is credited directly to your bank account.</p>', excerpt = 'PM Ujjwala Yojana provides free LPG connections to women from BPL families, with over 11 crore connections released since 2016. Eligible women receive a free cylinder, regulator, and safety hose. This guide covers the application process, required documents, and DBT subsidy details for LPG refills.', faqs = '[{"question":"Who is eligible for PM Ujjwala Yojana?","answer":"Women aged 18 years and above from BPL households are eligible. Priority is given to SC/ST families, households with manual scavengers, and families in backward districts. The applicant must not already have an LPG connection in the family name."},{"question":"What documents are needed for the application?","answer":"You need a BPL ration card or BPL certificate issued by the competent authority, Aadhaar card of the applicant, bank account details (for DBT), a recent passport-size photograph, and a consent form declaring that no other family member has an LPG connection."},{"question":"Where can I apply for the scheme?","answer":"You can apply at your nearest LPG distributor (Indian Oil, Bharat Gas, HP Gas) or through the online portal. You can also visit your local Anganwadi center or block development office for assistance."},{"question":"Is the LPG cylinder free under this scheme?","answer":"The first LPG connection is free, but subsequent cylinder refills are not free. However, the government provides a DBT subsidy on refills. The subsidy amount varies based on market rates and is credited directly to your bank account."}]' WHERE id = 13;

-- #14 Stand Up India Scheme 2026
UPDATE articles SET content = '<h2>Introduction</h2>
<p>Stand Up India Scheme was launched in April 2016 to promote entrepreneurship among Scheduled Castes (SC), Scheduled Tribes (ST), and women entrepreneurs. The scheme facilitates bank loans between ₹10 lakh and ₹1 crore for setting up greenfield enterprises in manufacturing, services, or trading sectors. This article explains the eligibility, loan terms, and step-by-step application process.</p>

<h2>Loan Features</h2>
<table><tr><th>Parameter</th><th>Details</th></tr>
<tr><td>Loan Amount</td><td>₹10 lakh to ₹1 crore</td></tr>
<tr><td>Target Borrowers</td><td>SC/ST and women entrepreneurs</td></tr>
<tr><td>Margin Money</td><td>10% — lowest among all government loan schemes</td></tr>
<tr><td>Repayment Period</td><td>Up to 7 years including moratorium</td></tr>
<tr><td>Interest Rate</td><td>As per RBI guidelines (usually 8-12%)</td></tr></table>

<h2>Frequently Asked Questions</h2>
<h3>Who can apply for Stand Up India loan?</h3>
<p>SC/ST borrowers and women entrepreneurs above 18 years of age are eligible. The applicant should have a viable business project in manufacturing, services, or trading sector. Greenfield projects (new enterprises) are preferred over expansion of existing businesses.</p>
<h3>Can one borrower get multiple Stand Up India loans?</h3>
<p>No, each borrower can avail only one loan under this scheme. However, multiple members of the same family can apply individually for their own separate enterprises. The loan is limited to one per borrower across all banks.</p>
<h3>Is there any subsidy on the interest rate?</h3>
<p>The scheme does not provide direct interest subsidy. However, loans are offered at competitive rates as per RBI guidelines. Some banks offer a 0.5% concession for women borrowers under their internal policies.</p>
<h3>How do I apply for Stand Up India loan?</h3>
<p>You can apply through the Stand Up India portal (standupmitra.in) which connects you to various banks. You need to submit your business plan, KYC documents, project cost estimate, and financial projections. The portal tracks your application status in real time.</p>', excerpt = 'Stand Up India Scheme offers loans from ₹10 lakh to ₹1 crore for SC/ST and women entrepreneurs at the lowest margin money requirement of just 10%. With repayment up to 7 years, this scheme has funded over 2 lakh greenfield enterprises since 2016. Learn eligibility, loan features, and how to apply through the Stand Up Mitra portal.', faqs = '[{"question":"Who can apply for Stand Up India loan?","answer":"SC/ST borrowers and women entrepreneurs above 18 years of age are eligible. The applicant should have a viable business project in manufacturing, services, or trading sector. Greenfield projects (new enterprises) are preferred over expansion of existing businesses."},{"question":"Can one borrower get multiple Stand Up India loans?","answer":"No, each borrower can avail only one loan under this scheme. However, multiple members of the same family can apply individually for their own separate enterprises. The loan is limited to one per borrower across all banks."},{"question":"Is there any subsidy on the interest rate?","answer":"The scheme does not provide direct interest subsidy. However, loans are offered at competitive rates as per RBI guidelines. Some banks offer a 0.5% concession for women borrowers under their internal policies."},{"question":"How do I apply for Stand Up India loan?","answer":"You can apply through the Stand Up India portal (standupmitra.in) which connects you to various banks. You need to submit your business plan, KYC documents, project cost estimate, and financial projections."}]' WHERE id = 14;
