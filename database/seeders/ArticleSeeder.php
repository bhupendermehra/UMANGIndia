<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        Article::create([
            'title' => 'Understanding PM-KISAN: Benefits, Eligibility, and Application Process',
            'title_hi' => 'पीएम-किसान की समझ: लाभ, पात्रता और आवेदन प्रक्रिया',
            'slug' => 'understanding-pm-kisan-benefits-eligibility-application',
            'content' => '<p>Pradhan Mantri Kisan Samman Nidhi (PM-KISAN) is a central sector scheme launched on February 24, 2019, to provide income support to all landholding farmers families across the country.</p><h3>Key Benefits</h3><p>Under the scheme, eligible farmer families receive Rs. 6,000 per year in three equal installments of Rs. 2,000 each. The amount is directly transferred to the bank accounts of beneficiaries through Direct Benefit Transfer (DBT).</p><h3>Eligibility Criteria</h3><ul><li>All landholding farmer families are eligible</li><li>Farmers with cultivable land in their name</li><li>The scheme is available to both male and female farmers</li><li>Certain categories like institutional land holders, income tax payers, and former government employees are excluded</li></ul><h3>Application Process</h3><p>Farmers can apply through their nearest Common Service Centre (CSC) or through the PM-KISAN portal. Self-registration is also available on the PM-KISAN website. Farmers need to provide their Aadhaar number, land records, and bank account details.</p>',
            'content_hi' => '<p>प्रधानमंत्री किसान सम्मान निधि (पीएम-किसान) एक केंद्रीय क्षेत्र की योजना है जो 24 फरवरी, 2019 को शुरू की गई थी, जो देश भर के सभी भूमि धारक किसान परिवारों को आय सहायता प्रदान करती है।</p>',
            'excerpt' => 'Learn everything you need to know about PM-KISAN scheme including eligibility, benefits worth Rs. 6,000/year, and how to apply online.',
            'excerpt_hi' => 'पीएम-किसान योजना के बारे में सब कुछ जानें जिसमें पात्रता, 6,000 रुपये प्रति वर्ष के लाभ और ऑनलाइन आवेदन कैसे करें शामिल हैं।',
            'status' => 'published',
            'is_featured' => true,
            'published_at' => now()->subDays(2),
            'source_url' => 'https://pmkisan.gov.in',
        ]);

        Article::create([
            'title' => 'Ayushman Bharat: India\'s Largest Healthcare Scheme Explained',
            'slug' => 'ayushman-bharat-healthcare-scheme-explained',
            'content' => '<p>Ayushman Bharat Pradhan Mantri Jan Arogya Yojana (AB-PMJAY) is the world\'s largest government-funded healthcare scheme. It provides health coverage of Rs. 5 lakh per family per year for secondary and tertiary care hospitalization.</p><h3>Coverage Details</h3><p>The scheme covers over 1,500 medical procedures including surgeries, medical treatments, and diagnostic services. It is available in both public and private empaneled hospitals across India.</p>',
            'excerpt' => 'Ayushman Bharat provides Rs. 5 lakh health cover per family. Complete guide on benefits, eligibility, and how to avail cashless treatment.',
            'status' => 'published',
            'is_featured' => true,
            'published_at' => now()->subDays(1),
            'source_url' => 'https://pmjay.gov.in',
        ]);

        Article::create([
            'title' => 'PM Awas Yojana: Housing for All by 2024 - Complete Guide',
            'slug' => 'pm-awas-yojana-housing-for-all-guide',
            'content' => '<p>Pradhan Mantri Awas Yojana (PMAY) is a flagship initiative by the Government of India to provide affordable housing to all urban and rural poor by 2024. The scheme has two components: PMAY-Urban and PMAY-Gramin.</p>',
            'excerpt' => 'Complete guide to PM Awas Yojana including subsidy details, eligibility criteria, application process, and list of required documents.',
            'status' => 'draft',
            'is_featured' => false,
            'published_at' => null,
        ]);

        Article::create([
            'title' => 'How to Apply for Scholarships Under National Scholarship Portal',
            'slug' => 'apply-scholarships-national-scholarship-portal',
            'content' => '<p>The National Scholarship Portal (NSP) is a one-stop platform for various scholarship schemes offered by the Government of India. Students can apply for central and state scholarships through this portal.</p>',
            'excerpt' => 'Step-by-step guide to applying for government scholarships through NSP including registration, document upload, and tracking application status.',
            'status' => 'published',
            'is_featured' => false,
            'published_at' => now(),
        ]);

        $this->command->info('ArticleSeeder: 4 sample articles created.');
    }
}