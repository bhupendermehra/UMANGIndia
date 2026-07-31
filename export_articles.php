<?php
// Export GOOD articles from SQLite and generate MySQL INSERT SQL
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Get articles with content length > 400 words (the good SEO drafts)
$good = App\Models\Article::whereRaw("LENGTH(content) > 1000")->where('status','published')->get();
echo "Found good articles in SQLite: " . $good->count() . "\n";

$fields = ['title','title_hi','slug','content','content_hi','excerpt','excerpt_hi','status','published_at'];
$sql = "-- INSERT good drafts to MySQL\n-- Generated: " . date('Y-m-d H:i:s') . "\n\n";

foreach ($good as $a) {
    // Check if slug already exists in MySQL
    $wc = str_word_count(strip_tags($a->content));
    $cols = []; $vals = [];
    foreach ($fields as $f) {
        $v = $a->$f;
        if ($v === null || $v === '') continue;
        $cols[] = "`$f`";
        $escaped = str_replace("'", "\\'", $v);
        $vals[] = "'$escaped'";
    }
    $sql .= "INSERT IGNORE INTO articles (" . implode(',', $cols) . ") VALUES (" . implode(',', $vals) . ");\n";
    echo "EXPORT: ID={$a->id} {$a->title} ({$wc}w)\n";
}

file_put_contents(__DIR__ . '/good_articles_mysql.sql', $sql);
echo "\nWritten: " . filesize(__DIR__ . '/good_articles_mysql.sql') . " bytes\n";