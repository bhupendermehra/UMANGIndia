<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('focus_keyword', 'like', "%{$search}%")
                  ->orWhere('meta_title', 'like', "%{$search}%");
            });
        }

        $articles = $query->latest()->paginate(20);
        $stats = [
            'total' => Article::withTrashed()->count(),
            'published' => Article::where('status', 'published')->count(),
            'drafts' => Article::where('status', 'draft')->count(),
            'trashed' => Article::onlyTrashed()->count(),
        ];

        return view('admin.articles.index', compact('articles', 'stats'));
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
            'meta_title' => 'nullable|string|max:70',
            'meta_description' => 'nullable|string|max:170',
            'focus_keyword' => 'nullable|string|max:100',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('articles', 'public');
        }

        $article = Article::create($validated);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'create',
            'model_type' => 'article',
            'model_id' => $article->id,
            'description' => "Created article: {$article->title}",
        ]);

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
            'meta_title' => 'nullable|string|max:70',
            'meta_description' => 'nullable|string|max:170',
            'focus_keyword' => 'nullable|string|max:100',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->filled('title') && $article->title !== $request->title) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('featured_image')) {
            if ($article->featured_image) {
                Storage::disk('public')->delete($article->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('articles', 'public');
        }

        $article->update($validated);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'model_type' => 'article',
            'model_id' => $article->id,
            'description' => "Updated article: {$article->title}",
        ]);

        return redirect()->route('admin.articles.edit', $article)
                        ->with('success', 'Article updated successfully.');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'model_type' => 'article',
            'model_id' => $article->id,
            'description' => "Deleted article: {$article->title}",
        ]);

        return redirect()->route('admin.articles.index')
                        ->with('success', 'Article moved to trash.');
    }

    public function restore($id)
    {
        $article = Article::withTrashed()->findOrFail($id);
        $article->restore();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'restore',
            'model_type' => 'article',
            'model_id' => $article->id,
            'description' => "Restored article: {$article->title}",
        ]);

        return back()->with('success', 'Article restored.');
    }

    public function bulkAction(Request $request)
    {
        $action = $request->input('bulk_action');
        $ids = $request->input('article_ids', []);

        if ($action === 'publish') {
            Article::whereIn('id', $ids)->update(['status' => 'published', 'published_at' => now()]);
        } elseif ($action === 'draft') {
            Article::whereIn('id', $ids)->update(['status' => 'draft']);
        } elseif ($action === 'trash') {
            Article::whereIn('id', $ids)->delete();
        }

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'bulk_' . $action,
            'model_type' => 'article',
            'description' => "Bulk {$action}: " . count($ids) . " articles",
        ]);

        return back()->with('success', count($ids) . ' articles updated.');
    }
}
