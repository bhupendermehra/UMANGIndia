<?php
// Dump thin schemes (<800 chars content) to public/progress/thin_schemes.json for content expansion.
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Scheme;

$rows = Scheme::with('category')->get()->filter(fn($s) => strlen(strip_tags($s->content)) < 800);

$out = [];
foreach ($rows as $s) {
    $out[] = [
        'id' => $s->id,
        'title' => $s->title,
        'title_hi' => $s->title_hi,
        'slug' => $s->slug,
        'category' => $s->category?->slug,
        'content_len' => strlen(strip_tags($s->content)),
        'content' => $s->content,
        'excerpt' => $s->excerpt,
        'eligibility' => $s->eligibility,
        'benefits' => $s->benefits,
        'official_website' => $s->official_website,
        'meta_title' => $s->meta_title,
    ];
}

$dir = __DIR__ . '/../public/progress';
if (!is_dir($dir)) mkdir($dir, 0775, true);
file_put_contents($dir . '/thin_schemes.json', json_encode($out, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "wrote " . count($out) . " schemes\n";
