<?php
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$schemes = App\Models\Scheme::with('category','state')->get();
$thin = 0;
$total = 0;
$missingHi = 0;
$top20 = [];

foreach ($schemes as $s) {
    $text = trim(strip_tags($s->title.' '.$s->short_description.' '.$s->content.' '.$s->eligibility.' '.$s->benefits.' '.$s->application_process.' '.$s->required_documents));
    $wc = str_word_count($text);
    $total++;
    if ($wc < 200) $thin++;
    if (empty($s->title_hi) && empty($s->content_hi)) $missingHi++;
}

echo "Total schemes: $total\n";
echo "Thin (<200 words): $thin\n";
echo "Missing Hindi: $missingHi\n";
echo "---\n";

// Articles
$pub = App\Models\Article::where('status','published')->count();
$draft = App\Models\Article::where('status','draft')->count();
echo "Published articles: $pub\n";
echo "Draft articles: $draft\n";
echo "---\n";

// Settings
echo "GSC: " . (App\Models\Setting::get('google_search_console') ?: 'NOT SET') . "\n";
echo "GA4: " . (App\Models\Setting::get('google_analytics_id') ?: 'NOT SET') . "\n";
echo "AdSense: " . (App\Models\Setting::get('adsense_enabled') ?: '0') . "\n";
