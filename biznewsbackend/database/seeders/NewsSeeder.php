<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;

class NewsSeeder extends Seeder
{
    public function run()
    {
        News::create([
            'title' => 'Breaking News: Laravel Rocks',
            'content' => 'Laravel is one of the best PHP frameworks.',
            'image' => 'news/laravel.jpg',
            'category' => 'politics',
            'author_id' => 1, // Assign to John Doe
            'heart_counts' => 100,
        ]);

        News::create([
            'title' => 'VueJS on the Rise',
            'content' => 'VueJS is becoming a popular frontend framework.',
            'image' => 'news/vuejs.jpg',
            'category' => 'politics',
            'author_id' => 2, // Assign to Jane Smith
            'heart_counts' => 150,
        ]);
    }
}
