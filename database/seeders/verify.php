<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->handle(new Symfony\Component\Console\Input\ArgvInput);

$articles = App\Models\Article::orderBy('id')->get();
echo "Total articles: " . $articles->count() . "\n\n";
foreach ($articles as $a) {
    echo "ID:{$a->id} | Slug:{$a->slug} | Status:{$a->status} | Title:{$a->title}\n";
}
