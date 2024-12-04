<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Author::create(['name' => 'John Doe', 'profile_picture' => 'path/to/image.jpg']);
        Author::create(['name' => 'Jane Doe', 'profile_picture' => 'path/to/image2.jpg']);
    }
}
