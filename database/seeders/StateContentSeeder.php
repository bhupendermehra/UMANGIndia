<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateContentSeeder extends Seeder
{
    /**
     * Genuine, state-specific editorial overviews for the five highest-priority
     * states (by population / scheme ecosystem). Each description is 150-250 words
     * and references real state portals and schemes so the content is useful and
     * not generic filler.
     */
    protected $content = [
        'maharashtra' => [
            'short_intro' => 'Maharashtra offers one of India’s most developed digital welfare networks, centred on the MahaDBT portal for scholarships, pensions, and farmer subsidies. Explore state and central schemes, check eligibility, and apply online or at Aaple Sarkar centres.',
            'description' => '<p>Maharashtra runs one of India’s most developed digital welfare ecosystems. The flagship MahaDBT portal (mahadbt.maharashtra.gov.in) is the single window for hundreds of post-matric scholarship, pension, and agriculture subsidy schemes, letting residents apply, upload documents, and track status online. The Aaple Sarkar civic portal and its network of 1,400+ Aaple Sarkar Seva Kendras handle caste, income, and domicile certificates that unlock most benefits. Health coverage is delivered through the Mahatma Jyotiba Phule Jan Arogya Yojana (MJPJAY), a state health insurance scheme for families below the poverty line, while the Annapurna Yojana supports affordable food grain for eligible households.</p><p>Farmers benefit from the Mukhyamantri Baliraja Shetkari Sanman Yojana loan waiver and input subsidies, and the state’s dairy and horticulture missions support cooperatives. Women and girl students access the Majhi Kanya Bhagyashree and various scholarship schemes. Applications are also assisted at CSC (Common Service Centre) kiosks and district social welfare offices for those without internet access. Residents should keep an Aadhaar-linked bank account and a valid income certificate ready. Because central schemes such as PM-KISAN and Ayushman Bharat also apply in Maharashtra, beneficiaries should check both the MahaDBT portal and the national portals to avoid missing entitlements.</p>',
        ],
        'uttar-pradesh' => [
            'short_intro' => 'Uttar Pradesh runs an extensive welfare system through its e-District portal and Jan Suvidha Kendras for certificates, pensions, and girl-child and farmer support. Explore eligibility and apply online or at CSC centres.',
            'description' => '<p>Uttar Pradesh, India’s most populous state, operates an extensive welfare delivery network centred on the UP e-District portal and the integrated Jan Suvidha Kendras that issue the caste, income, and residence certificates needed to claim most benefits. The state’s flagship Mukhyamantri Abhyudaya Yojana provides free coaching and mentorship for students preparing for competitive and entrance exams, while the Mukhyamantri Kanya Sumangala Yojana incentivises the education and welfare of girl children through conditional financial assistance at birth and key life stages.</p><p>Farmers are supported by the state’s own crop incentive top-ups alongside the central PM-KISAN transfers. The Vishwakarma Shram Samman Yojana offers toolkits and training to traditional artisans and craftspeople, and the Old Age, Widow, and Disabled pensions reach millions through the social welfare department. Uttar Pradesh also runs the One District One Product (ODOP) programme, pairing artisans and small manufacturers with credit and marketing support. Residents can apply online via the e-District and UP Vishwas portals, or visit CSC centres and tehsil offices for assisted application. Keeping an Aadhaar-linked bank account and a recent income certificate ensures faster approval and direct benefit transfer into the beneficiary’s account.</p>',
        ],
        'bihar' => [
            'short_intro' => 'Bihar delivers welfare through its Saat Nishchay programme, student credit cards, Jeevika self-help groups, and e-District services. Explore eligibility and apply online or at block offices and CSC centres.',
            'description' => '<p>Bihar has built a distinctive welfare model around its “Saat Nishchay” (Seven Resolves) guarantee programme, which underpins most state schemes. Under this umbrella, the Mukhyamantri Kanya Suraksha Yojana and Mukhyamantri Balika Protsahan Yojana support the education and safety of girls, while the Grameen Paribahan and Har Ghar Nal-Jal initiatives expand rural transport and tap-water connectivity. The Bihar Student Credit Card scheme offers up to ₹4 lakh in collateral-free education loans to eligible students, and the Kushal Yuva Program builds employability skills among youth.</p><p>The Jeevika mission, one of India’s largest self-help group networks, organises rural women into producer groups with access to credit and livelihoods. Farmers benefit from the state’s agricultural road maps and central PM-KISAN transfers, while the social welfare department runs old-age, widow, and disability pensions. Applications are made through the Bihar e-District portal and the ServicePlus portal, with assistance available at CSC centres and block offices. Residents should register with an Aadhaar-linked bank account and obtain income and residence certificates beforehand. Because central schemes such as Ayushman Bharat and PM Awas Yojana also cover Bihar, applicants should check both state and national portals to capture every eligible benefit.</p>',
        ],
        'west-bengal' => [
            'short_intro' => 'West Bengal brings schemes like Kanyashree, Swasthya Sathi, and Khadya Sathi to residents via e-District portals and Duare Sarkar camps. Explore eligibility and apply online or at Jana Seva Kendras.',
            'description' => '<p>West Bengal delivers a broad set of state schemes through its e-District portal, Jana Seva Kendras, and the popular Duare Sarkar (government at your doorstep) camps that bring certificate and benefit services directly to villages and neighbourhoods. The flagship Kanyashree Prakalpa gives conditional cash transfers to adolescent girls to keep them in education and delay early marriage, and has been replicated nationally. The Sabuj Sathi scheme distributes bicycles to students to improve school attendance, while Swasthya Sathi provides universal health coverage with smart cards for every family.</p><p>The Khadya Sathi programme ensures highly subsidised rice and wheat to the majority of households, and Rupashree offers one-time financial assistance for the marriage of eligible girls. Farmers and rural workers access the Krishak Bandhu income and insurance support, and the Karmashree scheme trains and places unemployed youth. Applicants can use the Banglarbhumi and e-District portals, or attend Duare Sarkar camps and CSC centres for assisted filing. An Aadhaar-linked bank account and a valid caste or income certificate streamline approvals. Central schemes such as PM-KISAN and Ayushman Bharat also apply, so residents should review both state and national portals.</p>',
        ],
        'madhya-pradesh' => [
            'short_intro' => 'Madhya Pradesh centres its welfare delivery on the Ladli Behna Yojana and the Samagra ID, linking families to pensions, scholarships, and farmer support. Explore eligibility and apply online or at CSC centres.',
            'description' => '<p>Madhya Pradesh, often called the heart of India, runs a large rural-focused welfare programme anchored by the Ladli Behna Yojana, which provides monthly financial assistance to eligible women to promote their economic independence and dignity. The Mukhyamantri Kisan Kalyan Yojana supplements central PM-KISAN transfers with an additional annual amount to small and marginal farmers, while the state’s crop insurance and input subsidy schemes protect against crop failure.</p><p>The Samagra Samajik Suraksha Mission issues a single Samagra ID that links families to pensions, scholarships, and ration benefits, simplifying eligibility and delivery. Students access post-matric scholarships and the Mukhyamantri Medhavi Vidyarthi Yojana for meritorious study, and the Teerth Darshan Yojana sponsors senior citizens’ pilgrimage. Applications are handled through the MP e-Kranti and e-District portals and the Samagra dashboard, with assisted help at CSC centres and district offices. Residents benefit most by linking an Aadhaar-seeded bank account and registering their Samagra ID early. Central schemes such as Ayushman Bharat, PM Awas Yojana, and PM-KISAN also operate across the state, so applicants should consult both the Samagra portal and national portals to claim all entitlements.</p>',
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->content as $slug => $data) {
            $affected = DB::table('states')
                ->where('slug', $slug)
                ->update($data);

            if ($affected === 0) {
                $this->command->warn("No state found with slug '{$slug}' — skipped.");
            } else {
                $this->command->info("Seeded editorial content for state slug '{$slug}'.");
            }
        }
    }
}
