<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    public function run()
    {
        $tags = ['Politics', 'Business', 'Corporate', 'Health', 'Education', 'Science'];
        foreach ($tags as $tag) {
            Tag::create(['name' => $tag]);
        }
    }
}