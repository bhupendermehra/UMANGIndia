<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Scheme;
use App\Models\Setting;
use App\Models\State;

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

        $recentSchemes = Scheme::with('category', 'state')
            ->latest()
            ->limit(10)
            ->get();

        $topViewed = Scheme::orderByDesc('views')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentSchemes', 'topViewed'));
    }
}
