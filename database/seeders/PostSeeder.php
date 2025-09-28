<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\Category\app\Models\Category;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all categories and users
        $categories = Category::all();
        $users = User::all();

        if ($categories->isEmpty() || $users->isEmpty()) {
            $this->command->warn('Please run the CategorySeeder and ensure you have users in the database before running the PostSeeder.');
            return;
        }

        // Create 50 posts
        Post::factory(50)->make()->each(function ($post) use ($users, $categories) {
            // Assign a random user to the post
            $post->user_id = $users->random()->id;
            $post->save();

            // Attach 1 to 3 random categories to the post
            $randomCategories = $categories->random(rand(1, 3))->pluck('id');
            $post->categories()->attach($randomCategories);
        });
    }
}