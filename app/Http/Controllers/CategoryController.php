<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Scheme;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $schemes = Scheme::active()
            ->where('category_id', $category->id)
            ->with('state')
            ->latest('published_at')
            ->paginate(20);

        // Featured schemes in this category
        $featuredSchemes = Scheme::active()
            ->where('category_id', $category->id)
            ->where('is_featured', true)
            ->with('state')
            ->latest()
            ->take(4)
            ->get();

        // State breakdown — grouped by state name, sorted by count
        $stateBreakdown = Scheme::active()
            ->where('category_id', $category->id)
            ->with('state')
            ->get()
            ->groupBy(fn($s) => $s->state?->name ?? 'Central')
            ->map(fn($items) => $items->count())
            ->sortDesc()
            ->take(6);

        // Quick stats
        $totalActive = Scheme::active()
            ->where('category_id', $category->id)
            ->count();

        $totalViews = Scheme::where('category_id', $category->id)
            ->sum('views');

        // Latest 3 schemes
        $latestSchemes = Scheme::active()
            ->where('category_id', $category->id)
            ->with('state')
            ->latest()
            ->take(3)
            ->get();

        $category->loadCount('schemes');

        return view('categories.show', compact(
            'category', 'schemes', 'featuredSchemes', 'stateBreakdown',
            'totalActive', 'totalViews', 'latestSchemes'
        ));
    }
}
