<?php

namespace App\Http\Controllers;

use App\Models\Scheme;
use App\Models\Category;
use App\Models\State;
use App\Models\Article;

class SitemapController extends Controller
{
    public function xml()
    {
        $schemes = Scheme::active()->latest('updated_at')->get();
        $categories = Category::all();
        $states = State::all();
        $articles = Article::where('status', 'published')->latest('updated_at')->get();

        return response()
            ->view('sitemap', compact('schemes', 'categories', 'states', 'articles'))
            ->header('Content-Type', 'text/xml');
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
