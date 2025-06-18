<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Product::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $foodId = DB::table('categories')->where('title', 'food')->value('category_id');
        $dessertId = DB::table('categories')->where('title', 'dessert')->value('category_id');
        $drinkId = DB::table('categories')->where('title', 'drink')->value('category_id');
        $products = [
            [
                'title' => 'Blueberry Cake',
                'description' => 'Delicious blueberry cake with fresh berries',
                'price' => 1.5,
                'image' => 'Masala.jpg',
                'quantity' => 50,
                'category_id' => 1, // Make sure this ID exists in your categories table
                'cuisine_id' => null, // Or set to appropriate cuisine ID
                'beverage_type_id' => null, // Or set to appropriate beverage type ID
                'delivery_time' => '00:15:00',
                'rating' => 4.0
            ],
            [
                'title' => 'Blueberry Cake',
                'description' => 'Delicious blueberry cake with fresh berries',
                'price' => 1.5,
                'image' => 'Hamburger.jpg',
                'quantity' => 50,
                'category_id' => 2, // Make sure this ID exists in your categories table
                'cuisine_id' => null, // Or set to appropriate cuisine ID
                'beverage_type_id' => null, // Or set to appropriate beverage type ID
                'delivery_time' => '00:15:00',
                'rating' => 4.0
            ],
            
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
}
