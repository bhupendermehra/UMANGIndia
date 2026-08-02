<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoMonitor;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class SeoMonitorController extends Controller
{
    public function index(Request $request)
    {
        $query = SeoMonitor::query();

        if ($request->has('check_type')) {
            $query->where('check_type', $request->check_type);
        }
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $checks = $query->latest('checked_at')->paginate(30);

        $summary = [
            'total' => SeoMonitor::count(),
            'passed' => SeoMonitor::where('status', 'pass')->count(),
            'failed' => SeoMonitor::where('status', 'fail')->count(),
            'warnings' => SeoMonitor::where('status', 'warning')->count(),
            'by_type' => SeoMonitor::selectRaw('check_type, COUNT(*) as count')
                ->groupBy('check_type')->pluck('count', 'check_type'),
        ];

        return view('admin.seo-monitor.index', compact('checks', 'summary'));
    }

    public function runCheck()
    {
        $urls = $this->sitemapUrls();

        $client = new Client([
            'timeout' => 8,
            'connect_timeout' => 5,
            'allow_redirects' => true,
            'headers' => ['User-Agent' => 'UmangIndia-SEO-Monitor/1.0'],
        ]);

        // Collect all checks, then replace today's rows for these URLs in one go
        $checks = [];
        foreach ($urls as $url) {
            try {
                $res = $client->get($url);
                $html = (string) $res->getBody();
                $checks = array_merge($checks, $this->inspect($url, $html));
            } catch (GuzzleException $e) {
                $checks[] = [
                    'page_url' => $url,
                    'check_type' => 'broken_link',
                    'status' => 'fail',
                    'issue_detail' => 'HTTP request failed: ' . $e->getMessage(),
                    'suggested_fix' => 'Verify the page loads',
                    'checked_at' => now(),
                ];
            }
        }

        // Replace existing rows for these URLs (keep history of other pages)
        if (!empty($urls)) {
            SeoMonitor::whereIn('page_url', $urls)->delete();
        }
        foreach ($checks as $c) {
            SeoMonitor::create($c);
        }

        $failed = count(array_filter($checks, fn($c) => $c['status'] === 'fail'));
        $warned = count(array_filter($checks, fn($c) => $c['status'] === 'warning'));

        \App\Models\ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'run_seo_check',
            'model_type' => 'seo_monitor',
            'description' => "SEO check run: " . count($urls) . " URLs, " . count($checks) . " checks ($failed failed, $warned warnings)",
        ]);

        return back()->with('success', "SEO check complete: " . count($urls) . " URLs checked, " . count($checks) . " results (" . $failed . " failed, " . $warned . " warnings).");
    }

    private function sitemapUrls(): array
    {
        try {
            $xml = @file_get_contents(url('/sitemap.xml'));
            if (!$xml) return [];
            preg_match_all('/<loc>(.*?)<\/loc>/', $xml, $m);
            // Cap at 60 URLs so a manual run finishes quickly on shared hosting
            return array_slice(array_map('trim', $m[1] ?? []), 0, 60);
        } catch (\Throwable $e) {
            return [];
        }
    }

    private function inspect(string $url, string $html): array
    {
        $out = [];

        // meta_title: <title> present, non-empty, <= 60 chars
        preg_match('/<title[^>]*>(.*?)<\/title>/is', $html, $t);
        $title = trim(strip_tags($t[1] ?? ''));
        if (empty($title)) {
            $out[] = $this->row($url, 'meta_title', 'fail', 'Missing <title> tag', 'Add a unique <title> (50-60 chars)');
        } elseif (mb_strlen($title) > 65) {
            $out[] = $this->row($url, 'meta_title', 'warning', 'Title too long: ' . mb_strlen($title) . ' chars', 'Trim title to 60 chars or less');
        } else {
            $out[] = $this->row($url, 'meta_title', 'pass', 'Title OK (' . mb_strlen($title) . ' chars)', null);
        }

        // meta_description
        preg_match('/<meta[^>]+name=["\']description["\'][^>]+content=["\'](.*?)["\']/is', $html, $d);
        if (!isset($d[1]) || trim($d[1]) === '') {
            preg_match('/<meta[^>]+content=["\'](.*?)["\'][^>]+name=["\']description["\']/is', $html, $d);
        }
        $desc = trim($d[1] ?? '');
        if (empty($desc)) {
            $out[] = $this->row($url, 'meta_description', 'fail', 'Missing meta description', 'Add meta description (140-160 chars)');
        } elseif (mb_strlen($desc) > 170 || mb_strlen($desc) < 60) {
            $out[] = $this->row($url, 'meta_description', 'warning', 'Description length: ' . mb_strlen($desc) . ' chars', 'Target 140-160 chars');
        } else {
            $out[] = $this->row($url, 'meta_description', 'pass', 'Description OK', null);
        }

        // h1: exactly one
        preg_match_all('/<h1[^>]*>(.*?)<\/h1>/is', $html, $h);
        $n = count($h[1] ?? []);
        if ($n === 0) {
            $out[] = $this->row($url, 'h1', 'fail', 'Missing <h1> tag', 'Add one H1 matching the page topic');
        } elseif ($n > 1) {
            $out[] = $this->row($url, 'h1', 'warning', $n . ' H1 tags found', 'Use exactly one H1');
        } else {
            $out[] = $this->row($url, 'h1', 'pass', 'One H1 present', null);
        }

        // canonical
        if (preg_match('/<link[^>]+rel=["\']canonical["\'][^>]*>/i', $html)) {
            $out[] = $this->row($url, 'canonical', 'pass', 'Canonical present', null);
        } else {
            $out[] = $this->row($url, 'canonical', 'fail', 'Missing canonical tag', 'Add rel=canonical pointing to the page URL');
        }

        // alt_text
        preg_match_all('/<img[^>]*>/i', $html, $imgs);
        $missingAlt = 0;
        foreach ($imgs[1] ?? [] as $img) {
            if (!preg_match('/alt=["\']/i', $img)) $missingAlt++;
        }
        if (empty($imgs[1])) {
            $out[] = $this->row($url, 'alt_text', 'pass', 'No images on page', null);
        } elseif ($missingAlt > 0) {
            $out[] = $this->row($url, 'alt_text', 'warning', $missingAlt . ' of ' . count($imgs[1]) . ' images missing alt text', 'Add alt attributes to all images');
        } else {
            $out[] = $this->row($url, 'alt_text', 'pass', 'All images have alt text', null);
        }

        // broken_link: page itself returned 200 (checked by caller)
        $out[] = $this->row($url, 'broken_link', 'pass', 'Page loads (HTTP 200)', null);

        return $out;
    }

    private function row(string $url, string $type, string $status, ?string $detail, ?string $fix): array
    {
        return [
            'page_url' => $url,
            'check_type' => $type,
            'status' => $status,
            'issue_detail' => $detail,
            'suggested_fix' => $fix,
            'checked_at' => now(),
        ];
    }
}
