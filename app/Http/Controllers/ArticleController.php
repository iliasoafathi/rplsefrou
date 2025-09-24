<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::query()
            ->where('is_visible', true)
            ->whereNotNull('published_at');

        // Search
        if ($search = trim((string) $request->get('q'))) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Date range filters
        if ($from = $request->get('from')) {
            $query->whereDate('published_at', '>=', $from);
        }
        if ($to = $request->get('to')) {
            $query->whereDate('published_at', '<=', $to);
        }

        $articles = $query->orderBy('published_at', 'desc')
            ->paginate(12)
            ->withQueryString();

        return view('articles.index', compact('articles'));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)
            ->where('is_visible', true)
            ->firstOrFail();

        // Get related articles (same category or recent articles)
        $relatedArticles = Article::where('is_visible', true)
            ->where('id', '!=', $article->id)
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->limit(4)
            ->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }
}
