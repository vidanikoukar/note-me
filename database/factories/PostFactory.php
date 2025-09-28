<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(rand(3, 8));

        return [
            'user_id' => User::factory(),
            'title' => $title,
            'content' => $this->faker->paragraphs(rand(5, 15), true),
            'excerpt' => $this->faker->paragraph(2),
            'slug' => Str::slug($title) . '-' . uniqid(),
            'published' => $this->faker->boolean(80), // 80% chance of being published
            'published_at' => now(),
            'views_count' => $this->faker->numberBetween(0, 10000),
            'likes_count' => $this->faker->numberBetween(0, 5000),
        ];
    }
}