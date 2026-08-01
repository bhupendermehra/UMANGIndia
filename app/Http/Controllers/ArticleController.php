<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::published()->latest('published_at');

        if ($request->query('filter') === 'featured') {
            $query->where('is_featured', true);
        }

        $articles = $query->paginate(10);

        $popularArticles = Article::published()->orderByDesc('view_count')->take(5)->get();

        return view('articles.index', compact('articles', 'popularArticles'));
    }

    public function show(Article $article)
    {
        if ($article->status !== 'published') {
            abort(404);
        }

        $popularArticles = Article::published()->where('id', '!=', $article->id)->orderByDesc('view_count')->take(5)->get();

        return view('articles.show', compact('article', 'popularArticles'));
    }
}