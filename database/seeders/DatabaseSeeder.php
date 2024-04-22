<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Delete folder articles
        Storage::deleteDirectory('articles');
        Storage::deleteDirectory('categories');
        // We create the folder newly
        Storage::makeDirectory('articles');
        Storage::makeDirectory('categories');
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // We call to seeder
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        
        // Factories
        Category::factory(8)->create();
        Article::factory(20)->create();
        Comment::factory(20)->create();
    }
}
