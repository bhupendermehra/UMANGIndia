<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$w = App\Models\Scheme::where('slug', 'wb-old-age-widow-pension-wb')->first();
if ($w) {
    echo "WB benefits FULL: " . $w->benefits . PHP_EOL;
    echo "---" . PHP_EOL;
    echo "WB short_desc FULL: " . $w->short_description . PHP_EOL;
}
