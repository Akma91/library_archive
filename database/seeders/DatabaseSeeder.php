<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
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
             'email' => 'admin@knjiznica.com',
         ]);

         User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@knjiznica.com',
        ]);

        Post::factory(30)->create();
        Author::factory(20)->create();
        Genre::factory(10)->create();
        Book::factory(50)->create();
    }
}
