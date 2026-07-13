<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Scheme;

class StateController extends Controller
{
    public function show(State $state)
    {
        $schemes = Scheme::active()
            ->where('state_id', $state->id)
            ->with('category')
            ->latest('published_at')
            ->paginate(20);

        // Featured schemes for this state
        $featuredSchemes = Scheme::active()
            ->where('state_id', $state->id)
            ->where('is_featured', true)
            ->with('category')
            ->latest()
            ->take(4)
            ->get();

        // Category breakdown — grouped by category name, sorted by count
        $categoryBreakdown = Scheme::active()
            ->where('state_id', $state->id)
            ->with('category')
            ->get()
            ->groupBy(fn($scheme) => $scheme->category->name ?? 'Uncategorized')
            ->map(fn($items) => $items->count())
            ->sortDesc()
            ->take(6);

        // Quick stats
        $totalActive = Scheme::active()
            ->where('state_id', $state->id)
            ->count();

        $totalViews = Scheme::where('state_id', $state->id)
            ->sum('views');

        // Central schemes (no state_id) — a few random ones relevant to this state
        $centralSchemes = Scheme::active()
            ->whereNull('state_id')
            ->with('category')
            ->inRandomOrder()
            ->take(3)
            ->get();

        // Most-viewed schemes for this state
        $popularSchemes = Scheme::active()
            ->where('state_id', $state->id)
            ->with('category')
            ->orderByDesc('views')
            ->take(6)
            ->get();

        // Related states for internal linking
        $relatedStates = State::where('id', '!=', $state->id)
            ->where('is_central', false)
            ->inRandomOrder()
            ->take(5)
            ->get();

        $state->loadCount('schemes');

        return view('states.show', compact(
            'state', 'schemes', 'featuredSchemes', 'categoryBreakdown',
            'totalActive', 'totalViews', 'centralSchemes',
            'popularSchemes', 'relatedStates'
        ));
    }
}
