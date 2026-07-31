<?php
// Generate MySQL UPDATE statements for scheme content fields
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$schemes = App\Models\Scheme::all();
$fields = ['content','eligibility','benefits','application_process','required_documents'];
$sql = "-- MySQL content updates for all schemes\n-- Generated: " . date('Y-m-d H:i:s') . "\n-- Source has " . $schemes->count() . " schemes\n\n";

foreach ($schemes as $s) {
    $sets = [];
    foreach ($fields as $f) {
        $v = $s->$f;
        if ($v !== null && $v !== '') {
            $escaped = str_replace("'", "\\'", $v);
            $sets[] = "`$f`='$escaped'";
        }
    }
    if (count($sets) > 0) {
        $sql .= "UPDATE schemes SET " . implode(', ', $sets) . " WHERE `slug`='{$s->slug}';\n";
    }
}

$path = __DIR__ . '/update_mysql.sql';
file_put_contents($path, $sql);
echo "Written: " . filesize($path) . " bytes, " . $schemes->count() . " schemes to update_mysql.sql\n";