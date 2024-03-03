<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleDeleteController extends Controller
{
    public function delete($slug)
    {
        $article = Article::where('slug', $slug)->first();

        if (!$article) {
            return response()->json([
                'error' => 'Article not found'
            ], 404);
        }

        $article->delete();

        return response()->json([
            'message' => 'Article deleted successfully'
        ], 204);
    }
}
