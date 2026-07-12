<?php

namespace App\Http\Controllers;

use App\Models\Scheme;
use App\Models\Category;
use App\Models\State;
use Illuminate\Http\Request;

class SchemeController extends Controller
{
    public function index(Request $request)
    {
        $query = Scheme::active()->with('category', 'state');

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('state')) {
            $query->where('state_id', $request->state);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('sort')) {
            match ($request->sort) {
                'popular' => $query->orderByDesc('views'),
                'deadline' => $query->orderBy('application_deadline'),
                default => $query->latest('published_at'),
            };
        } else {
            $query->latest('published_at');
        }

        $schemes = $query->paginate(20)->withQueryString();
        $categories = Category::withCount('schemes')->orderBy('sort_order')->get();
        $states = State::where('is_central', false)->orderBy('name')->get();

        return view('schemes.index', compact('schemes', 'categories', 'states'));
    }

    public function show(Scheme $scheme)
    {
        $scheme->incrementViews();
        $scheme->load('category', 'state', 'updates');

        $relatedSchemes = Scheme::active()
            ->where('category_id', $scheme->category_id)
            ->where('id', '!=', $scheme->id)
            ->with('category')
            ->limit(4)
            ->get();

        return view('schemes.show', compact('scheme', 'relatedSchemes'));
    }

    public function latest()
    {
        $schemes = Scheme::active()
            ->with('category')
            ->latest('published_at')
            ->paginate(20);

        return view('schemes.latest', compact('schemes'));
    }
}
