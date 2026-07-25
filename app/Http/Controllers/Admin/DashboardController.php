<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Scheme;
use App\Models\Category;
use App\Models\State;
use App\Models\SeoDraft;
use App\Models\ActivityLog;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_schemes' => Scheme::count(),
            'total_categories' => Category::count(),
            'total_states' => State::count(),
            'articles_published' => Article::where('status', 'published')->count(),
            'articles_draft' => Article::where('status', 'draft')->count(),
            'pending_drafts' => SeoDraft::where('status', 'pending_review')->count(),
            'total_articles' => Article::withTrashed()->count(),
            'sitemap_urls' => Scheme::count() + Category::count() + State::count() + Article::where('status', 'published')->count(),
        ];

        $recent_articles = Article::withTrashed()->latest()->take(5)->get();
        $recent_activity = ActivityLog::with('user')->latest()->take(10)->get();
        $pending_seo_drafts = SeoDraft::where('status', 'pending_review')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'stats', 'recent_articles', 'recent_activity', 'pending_seo_drafts'
        ));
    }
}
