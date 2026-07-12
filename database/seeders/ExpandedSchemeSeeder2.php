<?php

namespace Database\Seeders;

use App\Models\Scheme;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ExpandedSchemeSeeder2 extends Seeder
{
    public function run(): void
    {
        $jsonPath = database_path('seeders/expanded_schemes.json');
        $schemes = json_decode(file_get_contents($jsonPath), true);

        if (!$schemes) {
            $this->command->error('Could not load expanded_schemes.json');
            return;
        }

        $categories = Category::pluck('id', 'slug');
        $inserted = 0;
        $skipped = 0;

        $ap = 'Visit official website or nearest government office for application details.';
        $apHi = 'आवेदन विवरण के लिए आधिकारिक वेबसाइट या निकटतम सरकारी कार्यालय पर जाएं।';
        $rd = 'Aadhaar card, income certificate, category certificate (if applicable)';
        $rdHi = 'आधार कार्ड, आय प्रमाण, श्रेणी प्रमाण (यदि लागू हो)';

        foreach ($schemes as $s) {
            $categoryId = $categories[$s['cat']] ?? null;
            if (!$categoryId) { $skipped++; continue; }

            Scheme::updateOrCreate(
                ['slug' => $s['s']],
                [
                    'category_id' => $categoryId,
                    'state_id' => 1,
                    'title' => $s['t'] ?? '',
                    'title_hi' => $s['th'] ?? '',
                    'short_description' => $s['sh'] ?? '',
                    'short_description_hi' => $s['sh_th'] ?? '',
                    'status' => 'active',
                    'is_featured' => false,
                    'eligibility' => $s['el'] ?? '',
                    'eligibility_hi' => $s['el_th'] ?? '',
                    'benefits' => $s['be'] ?? '',
                    'benefits_hi' => $s['be_th'] ?? '',
                    'application_process' => $ap,
                    'application_process_hi' => $apHi,
                    'required_documents' => $rd,
                    'required_documents_hi' => $rdHi,
                    'content' => '<h2>' . ($s['t'] ?? '') . '</h2><p>' . ($s['sh'] ?? '') . '</p>',
                    'content_hi' => '<h2>' . ($s['th'] ?? '') . '</h2><p>' . ($s['sh_th'] ?? '') . '</p>',
                    'meta_title' => ($s['t'] ?? '') . ' | UmangIndia',
                    'meta_title_hi' => ($s['th'] ?? '') . ' | UmangIndia',
                    'meta_description' => mb_substr($s['sh'] ?? '', 0, 160),
                    'meta_description_hi' => mb_substr($s['sh_th'] ?? '', 0, 160),
                    'meta_keywords' => ($s['t'] ?? '') . ', India government scheme, UmangIndia',
                    'application_deadline' => null,
                ]
            );
            $inserted++;
        }

        $this->command->info("ExpandedSchemeSeeder2: {$inserted} schemes inserted, {$skipped} skipped.");
    }
}
