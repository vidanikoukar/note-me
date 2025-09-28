<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\Category\database\seeders\CategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a main admin user and some random users
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);
        User::factory(10)->create();

        // Call other seeders in the correct order
        $this->call([
            RolePermissionSeeder::class,
            CategorySeeder::class,
            PostSeeder::class,
        ]);
    }
}
