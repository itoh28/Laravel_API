<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Support\Str;

class ArticleUpdateController extends Controller
{
    public function update(Request $request, $slug)
    {
        $article = Article::where('slug', $slug)->first();

        if (!$article) {
            return response()->json([
                'error' => 'Article not found'
            ], 404);
        }

        $data = $request->input('article');

        if (isset($data['title'])) {
            $article->title = $data['title'];
            $article->slug = Str::slug($data['title']);
        }

        if (isset($data['description'])) {
            $article->description = $data['description'];
        }

        if (isset($data['body'])) {
            $article->body = $data['body'];
        }

        if (isset($data['tagList'])) {
            $article->tags()->detach();
            foreach ($data['tagList'] as $tagName) {
                $tag = Tag::firstOrCreate(['tag_name' => $tagName]);
                $article->tags()->attach($tag->id);
            }
        }

        $article->save();

        return response()->json([
            'article' => $article
        ]);
    }
}
