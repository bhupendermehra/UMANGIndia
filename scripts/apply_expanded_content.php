<?php
// Apply expanded scheme content from JSON files in public/progress/expanded/*.json
// Format per file: [ { "id": 7, "content": "<h2>Overview</h2><p>...</p>...", "official_website": "https://...", "meta_title": "...", "meta_description": "..." } ]
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Scheme;

$dir = __DIR__ . '/../public/progress/expanded';
if (!is_dir($dir)) { echo "no expanded dir\n"; exit(1); }

$applied = 0; $skipped = 0;
foreach (glob($dir . '/*.json') as $file) {
    $items = json_decode(file_get_contents($file), true);
    foreach ($items as $item) {
        $scheme = Scheme::find($item['id'] ?? null);
        if (!$scheme) { $skipped++; continue; }
        $data = [];
        if (!empty($item['content'])) $data['content'] = $item['content'];
        if (!empty($item['official_website'])) $data['official_website'] = $item['official_website'];
        if (!empty($item['meta_title'])) $data['meta_title'] = $item['meta_title'];
        if (!empty($item['meta_description'])) $data['meta_description'] = $item['meta_description'];
        if (!empty($item['excerpt'])) $data['excerpt'] = $item['excerpt'];
        if ($data) { $scheme->update($data); $applied++; }
        else { $skipped++; }
    }
}
echo "applied: $applied, skipped: $skipped\n";
