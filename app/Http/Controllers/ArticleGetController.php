<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleGetController extends Controller
{
    public function get($slug)
    {
        $article = Article::where('slug', $slug)->first();

        if (!$article) {
            return response()->json(['error' => 'Article not found'], 404);
        }

        return response()->json([
            'article' => [
                'slug' => $article->slug,
                'title' => $article->title,
                'description' => $article->description,
                'body' => $article->body,
                'tagList' => $article->tags->pluck('tag_name')->toArray(),
                'createdAt' => $article->created_at->toIso8601String(),
                'updatedAt' => $article->updated_at->toIso8601String(),
            ]
        ]);
    }
}
