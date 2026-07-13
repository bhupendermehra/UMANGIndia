<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$slugs = ['krishak-bandhu-wb','gatidhara-wb','banglar-bari-wb','sikshashree-wb','sambal-yojana-mp','ladli-laxmi-yojana-mp','mp-old-age-widow-pension-mp','gaon-ki-beti-pratibha-kiran-yojana-mp','balika-protsahan-yojana-bihar'];
foreach ($slugs as $s) {
    $m = App\Models\Scheme::where('slug', $s)->first();
    echo $s . ' => ' . ($m ? substr($m->benefits, 0, 150) : 'NOT FOUND') . PHP_EOL;
}
