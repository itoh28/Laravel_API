<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagController extends Controller
{
    public function tags()
    {
        $tags = Tag::all();

        $response = [];

        foreach ($tags as $tag) {
            $response[] = [
                'tagName' => $tag->tag_name,
            ];
        }

        return response()->json(['tags' => $response]);
    }
}
