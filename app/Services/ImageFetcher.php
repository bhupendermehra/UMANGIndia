<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImageFetcher
{
    public function fetchForUrl(string $url, string $storagePath = 'images/schemes'): ?string
    {
        $filename = md5($url) . '.jpg';
        $fullPath = "{$storagePath}/{$filename}";

        if (Storage::disk('public')->exists($fullPath)) {
            return $fullPath;
        }

        try {
            $response = Http::timeout(15)->get($url);
            if (!$response->successful()) return null;

            $contentType = $response->header('Content-Type');
            if (!str_contains($contentType ?? '', 'image')) return null;

            $ext = match (true) {
                str_contains($contentType, 'png') => 'png',
                str_contains($contentType, 'gif') => 'gif',
                str_contains($contentType, 'webp') => 'webp',
                str_contains($contentType, 'svg') => 'svg',
                default => 'jpg',
            };

            $filename = md5($url) . ".{$ext}";
            $fullPath = "{$storagePath}/{$filename}";

            Storage::disk('public')->put($fullPath, $response->body());
            Log::info("ImageFetcher: Downloaded {$url} → {$fullPath}");

            return $fullPath;
        } catch (\Exception $e) {
            Log::warning("ImageFetcher: Failed {$url}: {$e->getMessage()}");
            return null;
        }
    }

    public function findAndStoreSchemeImage(string $schemeName, string $slug): ?string
    {
        $googleSearch = "https://www.google.com/search?tbm=isch&q=" . urlencode("{$schemeName} government scheme logo");
        // Try official scheme portal first
        $portals = [
            "https://www.myscheme.gov.in/schemes/{$slug}/banner",
            "https://www.india.gov.in/sites/upload_files/cti/files/schemes/{$slug}.jpg",
        ];

        foreach ($portals as $url) {
            $result = $this->fetchForUrl($url);
            if ($result) return $result;
        }

        return null;
    }
}