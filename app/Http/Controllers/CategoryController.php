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

        $category->loadCount('schemes');

        return view('categories.show', compact('category', 'schemes'));
    }
}
