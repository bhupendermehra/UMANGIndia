<?php

namespace App\Services;

use App\Models\Article;
use App\Models\SchemeUpdate;
use Illuminate\Support\Str;

class BlogGenerator
{
    public function generateFromUpdate(SchemeUpdate $update): ?Article
    {
        $scheme = $update->scheme;
        $schemeName = $scheme?->title ?? 'Government Scheme';

        $title = $this->generateTitle($update, $schemeName);
        $slug = $this->ensureUniqueSlug(Str::slug($title));
        $content = $this->generateContent($update, $scheme, $schemeName);
        $excerpt = Str::limit(strip_tags($content), 160);

        return Article::create([
            'title' => $title,
            'slug' => $slug,
            'content' => $content,
            'excerpt' => $excerpt,
            'source_url' => $update->source_url,
            'status' => 'draft',
            'is_featured' => false,
            'published_at' => now(),
        ]);
    }

    private function generateTitle(SchemeUpdate $update, string $schemeName): string
    {
        $text = strtolower($update->title);
        if (str_contains($text, 'launch') || str_contains($text, 'introduce')) {
            return "New {$schemeName} Initiative Launched: {$update->title}";
        }
        if (str_contains($text, 'deadline') || str_contains($text, 'extend')) {
            return "Important Update: Deadline Extended for {$schemeName}";
        }
        if (str_contains($text, 'benefit') || str_contains($text, 'payment')) {
            return "Benefit Update: {$schemeName} - {$update->title}";
        }
        return "Latest Update: {$schemeName} - {$update->title}";
    }

    private function generateContent(SchemeUpdate $update, $scheme, string $schemeName): string
    {
        $desc = $scheme?->short_description ?? 'A government initiative for citizens.';
        $elig = $scheme?->eligibility ?? 'Check official website for eligibility criteria.';
        $benefits = $scheme?->benefits ?? 'Various benefits as per scheme guidelines.';

        return <<<HTML
<h2>{$update->title}</h2>
<p><strong>Last Updated:</strong> {$update->created_at->format('F d, Y')}</p>

<h3>About {$schemeName}</h3>
<p>{$desc}</p>

<h4>Eligibility</h4>
<p>{$elig}</p>

<h4>Benefits</h4>
<p>{$benefits}</p>

<h3>Latest Update Details</h3>
<p>{$update->content}</p>

<h3>How to Apply</h3>
<p>Applications can be submitted online via the official portal or through designated government offices. Always verify the latest application process from official sources.</p>
HTML;
    }

    private function ensureUniqueSlug(string $slug): string
    {
        $original = $slug;
        $count = 1;
        while (Article::where('slug', $slug)->exists()) {
            $slug = "{$original}-{$count}";
            $count++;
        }
        return $slug;
    }
}