<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Str;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::withTrashed();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
        }

        $articles = $query->latest()->paginate(20);

        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_hi' => 'nullable|string|max:255',
            'content' => 'required|string',
            'content_hi' => 'nullable|string',
            'excerpt' => 'nullable|string',
            'excerpt_hi' => 'nullable|string',
            'source_url' => 'nullable|url',
            'status' => 'in:draft,published,archived',
            'is_featured' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $article = Article::create($validated);

        return redirect()->route('admin.articles.edit', $article)
                        ->with('success', 'Article created successfully.');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_hi' => 'nullable|string|max:255',
            'content' => 'required|string',
            'content_hi' => 'nullable|string',
            'excerpt' => 'nullable|string',
            'excerpt_hi' => 'nullable|string',
            'source_url' => 'nullable|url',
            'status' => 'in:draft,published,archived',
            'is_featured' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        if ($article->isDirty('title')) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $article->update($validated);

        return redirect()->route('admin.articles.edit', $article)
                        ->with('success', 'Article updated successfully.');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('admin.articles.index')
                        ->with('success', 'Article moved to trash.');
    }

    public function restore($id)
    {
        $article = Article::withTrashed()->findOrFail($id);
        $article->restore();

        return back()->with('success', 'Article restored.');
    }
}