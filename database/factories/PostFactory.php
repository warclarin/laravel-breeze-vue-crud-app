<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->sentence(rand(6, 10));

        return [
            'title' => $title,
            'body' => fake()->paragraphs(rand(4, 10), true),
            'slug'  => Str::slug($title),
            'author_id' => 1,
            'is_published' => true,
        ];
    }
}
