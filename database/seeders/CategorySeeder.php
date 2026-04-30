<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Technologie', 'slug' => 'technologie'],
            ['name' => 'Design', 'slug' => 'design'],
            ['name' => 'Laravel', 'slug' => 'laravel'],
            ['name' => 'Tailwind CSS', 'slug' => 'tailwind-css'],
            ['name' => 'Actualités', 'slug' => 'actualites'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}