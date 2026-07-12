<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Scheme;
use App\Models\SchemeUpdate;
use Carbon\Carbon;

class GovDataFetcher
{
    protected array $sources = [
        'pmkisan' => [
            'url' => 'https://pmkisan.gov.in/rss/news.xml',
            'type' => 'rss',
            'parser' => 'parseDefaultItem',
        ],
        'india_gov' => [
            'url' => 'https://www.india.gov.in/rss.xml',
            'type' => 'rss',
            'parser' => 'parseDefaultItem',
        ],
        'pib' => [
            'url' => 'https://pib.gov.in/RssMain.aspx?modid=12&lang=1',
            'type' => 'rss',
            'parser' => 'parseDefaultItem',
        ],
    ];

    public function fetchAll(): void
    {
        foreach ($this->sources as $name => $config) {
            try {
                $this->fetchAndStore($name, $config['url'], $config['type'], $config['parser']);
            } catch (\Exception $e) {
                Log::error("GovDataFetcher: Failed to fetch {$name}: {$e->getMessage()}");
            }
        }
    }

    protected function fetchAndStore(string $source, string $url, string $type, string $parser): void
    {
        $response = ($type === 'rss') ? $this->fetchRss($url) : $this->fetchJson($url);
        if (!$response) return;

        foreach ($response as $item) {
            $externalId = $item['guid'] ?? $item['link'] ?? md5($item['title']);
            $existing = SchemeUpdate::where('source', $source)
                ->where('external_id', $externalId)
                ->exists();
            if ($existing) continue;

            $parsed = $this->{$parser}($item, $source);
            if (!$parsed) continue;

            $scheme = $this->findRelatedScheme($parsed['title'], $parsed['content']);

            SchemeUpdate::create([
                'scheme_id' => $scheme?->id,
                'source' => $source,
                'external_id' => $externalId,
                'title' => $parsed['title'],
                'content' => $parsed['content'],
                'source_url' => $item['link'] ?? null,
                'published_at' => $parsed['date'] ?? now(),
            ]);
        }
    }

    protected function fetchRss(string $url): ?array
    {
        $xml = @simplexml_load_file($url);
        if (!$xml || !isset($xml->channel->item)) return null;

        $items = [];
        foreach ($xml->channel->item as $item) {
            $items[] = [
                'title' => (string)$item->title,
                'link' => (string)$item->link,
                'description' => (string)$item->description,
                'pubDate' => (string)$item->pubDate,
                'guid' => (string)$item->guid,
            ];
        }
        return $items;
    }

    protected function fetchJson(string $url): ?array
    {
        $response = Http::timeout(30)->get($url);
        if (!$response->successful()) return null;
        return $response->json();
    }

    protected function parseDefaultItem(array $item, string $source): array
    {
        return [
            'id' => $item['guid'] ?? '',
            'title' => strip_tags(html_entity_decode($item['title'] ?? '', ENT_QUOTES, 'UTF-8')),
            'content' => strip_tags(html_entity_decode($item['description'] ?? '', ENT_QUOTES, 'UTF-8')),
            'date' => isset($item['pubDate']) ? Carbon::parse($item['pubDate']) : null,
        ];
    }

    protected function findRelatedScheme(string $title, string $content): ?Scheme
    {
        $keywords = [
            'pm kisan' => 'pm-kisan',
            'kisan' => 'pm-kisan',
            'ayushman' => 'ayushman-bharat',
            'pm awas' => 'pm-awas-yojana',
            'awas yojana' => 'pm-awas-yojana',
            'nrega' => 'mgnrega',
            'mnrega' => 'mgnrega',
            'ujjwala' => 'ujjwala-yojana',
            'skill' => 'pm-kaushal-vikas-yojana',
            'pension' => 'pm-shram-yogi-maandhan-yojana',
            'jan dhan' => 'pm-jan-dhan-yojana',
            'sukanya' => 'sukanya-samriddhi-yojana',
            'digital india' => 'digital-india-mission',
            'startup india' => 'startup-india',
        ];

        $text = strtolower($title . ' ' . $content);
        foreach ($keywords as $word => $slug) {
            if (str_contains($text, $word)) {
                return Scheme::where('slug', $slug)->first();
            }
        }
        return null;
    }
}