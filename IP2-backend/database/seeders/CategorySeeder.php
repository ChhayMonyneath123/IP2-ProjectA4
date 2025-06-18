<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'title' => 'food',
                'description' => 'All food items',
                'image_url' => 'categories/food.jpg'
            ],
            [
                'title' => 'dessert',
                'description' => 'Sweet desserts',
                'image_url' => 'categories/dessert.jpg'
            ],
            [
                'title' => 'drink',
                'description' => 'Beverages and drinks',
                'image_url' => 'categories/drink.jpg'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
