<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence;
        $slug = Str::slug($title);
        $description = $this->faker->sentence;
        $body = $this->faker->paragraph;

        return [
            'title' => $title,
            'slug' => $slug,
            'description' => $description,
            'body' => $body,
        ];
    }
}
