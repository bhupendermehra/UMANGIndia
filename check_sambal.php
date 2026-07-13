<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$m = App\Models\Scheme::where('slug', 'sambal-yojana-mp')->first();
if ($m) {
    echo "short_description: " . substr($m->short_description, 0, 150) . PHP_EOL;
    echo "content: " . substr($m->content, 0, 200) . PHP_EOL;
}

$w = App\Models\Scheme::where('slug', 'wb-old-age-widow-pension-wb')->first();
if ($w) {
    echo "WB title: " . $w->title . PHP_EOL;
    echo "WB benefits: " . substr($w->benefits, 0, 150) . PHP_EOL;
    echo "WB short_desc: " . substr($w->short_description, 0, 150) . PHP_EOL;
}
