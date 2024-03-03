<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Article;

class ArticleEndpointTest extends TestCase
{
    use RefreshDatabase;

    public function testDeleteArticle()
    {
        $article = Article::factory()->create();

        $response = $this->delete("/api/articles/{$article->slug}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('articles', [
            'id' => $article->id,
        ]);
    }
}
