<?php
/**
 * Fix long titles and duplicate meta descriptions for schemes.
 * Run: php fix_seo_meta.php
 */

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Scheme;
use App\Models\Article;

echo "=== Fixing long titles ===\n";

$schemes = Scheme::whereRaw('LENGTH(meta_title) > 60')->orWhereRaw('LENGTH(title) > 60')->get();
echo "Found " . $schemes->count() . " schemes with long titles\n";

foreach ($schemes as $scheme) {
    $original = $scheme->meta_title;
    if (mb_strlen($original) <= 60) continue;
    
    // Smart truncate: find a good break point
    $trimmed = $original;
    // Try to cut at the last space before 57 chars, then add "..." 
    if (mb_strlen($trimmed) > 60) {
        $cut = mb_substr($trimmed, 0, 57);
        $lastSpace = mb_strrpos($cut, ' ');
        if ($lastSpace > 20) { // Only use break point if reasonable
            $trimmed = mb_substr($cut, 0, $lastSpace) . '...';
        } else {
            $trimmed = mb_substr($trimmed, 0, 57) . '...';
        }
    }
    
    $scheme->meta_title = $trimmed;
    $scheme->save();
    echo "  Trimmed: " . mb_substr($original, 0, 50) . "... → " . $trimmed . "\n";
}

// Fix articles too
$articles = Article::whereRaw('LENGTH(meta_title) > 60')->get();
echo "\nFound " . $articles->count() . " articles with long titles\n";
foreach ($articles as $article) {
    $original = $article->meta_title;
    if (mb_strlen($original) <= 60) continue;
    
    $trimmed = $original;
    if (mb_strlen($trimmed) > 60) {
        $cut = mb_substr($trimmed, 0, 57);
        $lastSpace = mb_strrpos($cut, ' ');
        if ($lastSpace > 20) {
            $trimmed = mb_substr($cut, 0, $lastSpace) . '...';
        } else {
            $trimmed = mb_substr($cut, 0, 57) . '...';
        }
    }
    
    $article->meta_title = $trimmed;
    $article->save();
    echo "  Trimmed: " . $original . " → " . $trimmed . "\n";
}

echo "\n=== Fixing duplicate meta descriptions ===\n";

// Find duplicate meta descriptions in schemes
$duplicates = Scheme::selectRaw('meta_description, COUNT(*) as cnt')
    ->whereNotNull('meta_description')
    ->groupBy('meta_description')
    ->having('cnt', '>', 1)
    ->get();

echo "Found " . $duplicates->count() . " duplicate meta descriptions\n";

foreach ($duplicates as $dup) {
    $schemes = Scheme::where('meta_description', $dup->meta_description)->get();
    foreach ($schemes as $i => $scheme) {
        if ($i > 0) { // Keep first as-is, make others unique
            $shortDesc = $scheme->short_description;
            $uniqueDesc = mb_substr($shortDesc ?: ($scheme->title . ' - Learn about eligibility, benefits and application process.'), 0, 155);
            $scheme->meta_description = $uniqueDesc;
            $scheme->save();
            echo "  Updated: {$scheme->slug} → {$uniqueDesc}\n";
        }
    }
}

echo "\nDone.\n";
