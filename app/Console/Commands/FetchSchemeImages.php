<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ImageFetcher;
use App\Models\Scheme;

class FetchSchemeImages extends Command
{
    protected $signature = 'images:fetch-schemes {--limit=10 : Number of schemes to process}';
    protected $description = 'Fetch images for schemes that dont have one yet';

    public function handle(ImageFetcher $fetcher): int
    {
        $schemes = Scheme::whereNull('image')->limit((int)$this->option('limit'))->get();

        if ($schemes->isEmpty()) {
            $this->info('No schemes need images.');
            return 0;
        }

        $this->info("Processing {$schemes->count()} schemes...");

        foreach ($schemes as $scheme) {
            $this->line("  Fetching: {$scheme->title}");
            $path = $fetcher->findAndStoreSchemeImage($scheme->title, $scheme->slug);
            if ($path) {
                $scheme->update(['image' => $path]);
                $this->info("    ✓ Image saved: {$path}");
            } else {
                $this->warn("    ✗ No image found");
            }
        }

        $this->info('Done.');
        return 0;
    }
}