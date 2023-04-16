<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Post;
use App\Models\User;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
             'name' => 'Admin User',
             'email' => 'test@example.com',
         ]);

        Post::factory(30)->create();

        Book::factory(50)->create();
    }
}
