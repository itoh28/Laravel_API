<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Support\Str;

class ArticleCreateController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->input('article');


        $slug = Str::slug($data['title']);

        $article = Article::create([
            'title' => $data['title'],
            'slug' => $slug,
            'description' => $data['description'],
            'body' => $data['body'],
        ]);

        if (isset($data['tagList']) && is_array($data['tagList'])) {
            foreach ($data['tagList'] as $tagName) {
                $tag = Tag::firstOrCreate(['tag_name' => $tagName]);
                $article->tags()->attach($tag->id);
            }
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
        ], 201);
    }
}
