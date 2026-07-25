<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoDraft;
use Illuminate\Http\Request;
use Str;

class SeoDraftController extends Controller
{
    public function index(Request $request)
    {
        $query = SeoDraft::with('reviewer');

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $drafts = $query->latest()->paginate(20);
        $stats = [
            'pending' => SeoDraft::where('status', 'pending_review')->count(),
            'approved' => SeoDraft::where('status', 'approved')->count(),
            'rejected' => SeoDraft::where('status', 'rejected')->count(),
            'imported' => SeoDraft::where('status', 'imported')->count(),
        ];

        return view('admin.seo-drafts.index', compact('drafts', 'stats'));
    }

    public function show(SeoDraft $draft)
    {
        return view('admin.seo-drafts.show', compact('draft'));
    }

    public function approve(Request $request, SeoDraft $draft)
    {
        $validated = $request->validate([
            'review_notes' => 'nullable|string|max:1000',
        ]);

        $draft->update([
            'status' => 'approved',
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
            'review_notes' => $validated['review_notes'] ?? null,
        ]);

        return redirect()->route('admin.seo-drafts.index')
                        ->with('success', 'Draft approved. Ready for publishing.');
    }

    public function reject(Request $request, SeoDraft $draft)
    {
        $validated = $request->validate([
            'review_notes' => 'nullable|string|max:1000',
        ]);

        $draft->update([
            'status' => 'rejected',
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
            'review_notes' => $validated['review_notes'] ?? null,
        ]);

        return redirect()->route('admin.seo-drafts.index')
                        ->with('error', 'Draft rejected.');
    }

    public function publishAsArticle(Request $request, SeoDraft $draft)
    {
        $article = \App\Models\Article::create([
            'title' => $draft->title,
            'slug' => Str::slug($draft->title),
            'content' => $draft->content,
            'excerpt' => $draft->excerpt,
            'source_url' => $draft->source_url,
            'focus_keyword' => $draft->target_keyword,
            'status' => 'published',
            'published_at' => now(),
            'meta_title' => $draft->title,
        ]);

        $draft->update(['status' => 'imported']);

        return redirect()->route('admin.articles.edit', $article)
                        ->with('success', 'Draft published as article. You can now edit SEO metadata.');
    }
}
