<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Scheme;
use App\Models\Setting;
use App\Models\Share;
use App\Models\State;
use App\Models\Subscriber;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_schemes' => Scheme::count(),
            'active_schemes' => Scheme::where('status', 'active')->count(),
            'total_categories' => Category::count(),
            'total_states' => State::count(),
            'total_views' => Scheme::sum('views'),
            'featured_schemes' => Scheme::where('is_featured', true)->count(),
        ];

        $schemesWithMissingData = Scheme::whereNull('short_description')
            ->orWhere('short_description', '')
            ->count();

        $schemesWithNoHindi = Scheme::whereNull('title_hi')
            ->orWhere('title_hi', '')
            ->count();

        $schemesWithNoDeadline = Scheme::whereNull('application_deadline')
            ->orWhere('application_deadline', '')
            ->count();

        $totalSubscribers = Subscriber::count();
        $totalShares = Share::count();

        // Article stats — only if Article model exists
        $totalArticles = 0;
        $draftArticles = 0;
        if (class_exists('App\Models\Article')) {
            $totalArticles = Article::count();
            $draftArticles = Article::where('status', 'draft')->count();
        }

        $recentSchemes = Scheme::with('category', 'state')
            ->latest()
            ->limit(10)
            ->get();

        $topViewed = Scheme::orderByDesc('views')
            ->limit(5)
            ->get();

        $trendingSchemes = Scheme::orderByDesc('views')
            ->where('created_at', '>=', now()->subDays(7))
            ->limit(5)
            ->get();

        $upcomingDeadlines = Scheme::where('status', 'active')
            ->whereNotNull('application_deadline')
            ->where('application_deadline', '>=', now())
            ->orderBy('application_deadline')
            ->limit(5)
            ->get();

        $featuredCount = Scheme::where('is_featured', true)->count();

        return view('admin.dashboard', compact(
            'stats',
            'recentSchemes',
            'topViewed',
            'trendingSchemes',
            'upcomingDeadlines',
            'featuredCount',
            'schemesWithMissingData',
            'schemesWithNoHindi',
            'schemesWithNoDeadline',
            'totalSubscribers',
            'totalShares',
            'totalArticles',
            'draftArticles'
        ));
    }
}
