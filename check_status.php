<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
echo "Schemes: ".App\Models\Scheme::count().PHP_EOL;
echo "Articles: ".App\Models\Article::count().PHP_EOL;
echo "Published Articles: ".App\Models\Article::where('status','published')->count().PHP_EOL;
echo "Draft Articles: ".App\Models\Article::where('status','draft')->count().PHP_EOL;
?>