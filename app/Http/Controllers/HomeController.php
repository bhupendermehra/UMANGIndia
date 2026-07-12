<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Scheme;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredSchemes = Scheme::active()->featured()->with('category')->limit(6)->get();
        $latestSchemes = Scheme::active()->with('category')->latest('published_at')->limit(12)->get();
        $categories = Category::withCount('schemes')->orderBy('sort_order')->get();
        $totalSchemes = Scheme::active()->count();

        return view('home', compact('featuredSchemes', 'latestSchemes', 'categories', 'totalSchemes'));
    }
}
