<?php

namespace App\Http\Controllers;

use App\Models\Scheme;
use App\Models\Category;
use App\Models\State;

class SitemapController extends Controller
{
    public function xml()
    {
        $schemes = Scheme::active()->latest('updated_at')->get();
        $categories = Category::all();
        $states = State::all();

        return response()
            ->view('sitemap.xml', compact('schemes', 'categories', 'states'))
            ->header('Content-Type', 'application/xml');
    }

    public function robots()
    {
        $content = "User-agent: *
Allow: /
Disallow: /admin/
Disallow: /api/
Sitemap: " . url('/sitemap.xml');
        return response($content)->header('Content-Type', 'text/plain');
    }
}
