<?php

namespace App\Http\Controllers;

use App\Models\Scheme;
use App\Models\Category;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    public function index()
    {
        $schemes = Scheme::active()->with('category')->latest()->paginate(50);
        $categories = Category::withCount('schemes')->get();
        return view('compare.index', compact('schemes', 'categories'));
    }

    public function compare(Request $request)
    {
        $ids = $request->input('schemes', []);
        if (count($ids) < 2 || count($ids) > 3) {
            return redirect()->route('compare.index')
                ->with('error', 'Please select 2 or 3 schemes to compare.');
        }
        
        $schemes = Scheme::with('category', 'state')
            ->whereIn('id', $ids)
            ->get();
            
        if ($schemes->count() < 2) {
            return redirect()->route('compare.index')
                ->with('error', 'Invalid selection. Please try again.');
        }
        
        return view('compare.result', compact('schemes'));
    }
}
