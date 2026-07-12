<?php

namespace App\Http\Controllers;

use App\Models\Scheme;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        $results = collect();

        if ($query && strlen($query) >= 2) {
            $results = Scheme::active()
                ->where(function ($q) use ($query) {
                    $q->where('title', 'LIKE', "%{$query}%")
                      ->orWhere('short_description', 'LIKE', "%{$query}%")
                      ->orWhere('content', 'LIKE', "%{$query}%")
                      ->orWhere('eligibility', 'LIKE', "%{$query}%")
                      ->orWhere('benefits', 'LIKE', "%{$query}%");
                })
                ->with('category')
                ->paginate(20)
                ->appends(['q' => $query]);
        }

        return view('search.index', compact('query', 'results'));
    }
}
