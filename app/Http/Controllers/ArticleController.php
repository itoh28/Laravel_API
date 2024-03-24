<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->get();

        $response = [];

        foreach ($articles as $article) {
            $response[] = [
                'slug' => $article->slug,
                'title' => $article->title,
                'description' => $article->description,
                'body' => $article->body,
                'tagList' => $article->tags->pluck('tag_name')->toArray(),
                'createdAt' => $article->created_at->toIso8601String(),
                'updatedAt' => $article->updated_at->toIso8601String(),
            ];
        }

        return response()->json(['articles' => $response]);
    }

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

    public function show($slug)
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
