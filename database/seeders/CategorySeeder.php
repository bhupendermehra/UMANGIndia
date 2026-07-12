<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Education', 'slug' => 'education', 'icon' => '📚', 'sort_order' => 1, 'description' => 'Scholarships, school schemes, higher education subsidies and skill development programs.'],
            ['name' => 'Health', 'slug' => 'health', 'icon' => '🏥', 'sort_order' => 2, 'description' => 'Health insurance, hospital schemes, medical subsidies and wellness programs.'],
            ['name' => 'Agriculture', 'slug' => 'agriculture', 'icon' => '🌾', 'sort_order' => 3, 'description' => 'Farm subsidies, crop insurance, irrigation schemes and farmer welfare programs.'],
            ['name' => 'Housing', 'slug' => 'housing', 'icon' => '🏠', 'sort_order' => 4, 'description' => 'Affordable housing, home loans subsidies and urban/rural housing schemes.'],
            ['name' => 'Employment', 'slug' => 'employment', 'icon' => '💼', 'sort_order' => 5, 'description' => 'Job creation, self-employment, skill training and startup funding schemes.'],
            ['name' => 'Social Welfare', 'slug' => 'social-welfare', 'icon' => '🤝', 'sort_order' => 6, 'description' => 'Pension schemes, disability support, senior citizen welfare and social security.'],
            ['name' => 'Women & Child', 'slug' => 'women-child', 'icon' => '👩', 'sort_order' => 7, 'description' => 'Women empowerment, child protection, maternity benefits and girl child schemes.'],
            ['name' => 'Financial Inclusion', 'slug' => 'financial-inclusion', 'icon' => '💰', 'sort_order' => 8, 'description' => 'Banking schemes, insurance, pensions and financial literacy programs.'],
            ['name' => 'Digital India', 'slug' => 'digital-india', 'icon' => '💻', 'sort_order' => 9, 'description' => 'Digital literacy, internet access, e-governance and technology schemes.'],
            ['name' => 'Infrastructure', 'slug' => 'infrastructure', 'icon' => '🏗️', 'sort_order' => 10, 'description' => 'Road, water supply, electrification and smart city development schemes.'],
            ['name' => 'Environment', 'slug' => 'environment', 'icon' => '🌱', 'sort_order' => 11, 'description' => 'Clean energy, pollution control, water conservation and green initiatives.'],
            ['name' => 'Senior Citizen', 'slug' => 'senior-citizen', 'icon' => '👴', 'sort_order' => 12, 'description' => 'Pension, healthcare, travel concessions and welfare for elderly citizens.'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
