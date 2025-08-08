<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Classic Cheeseburger',
                'description' => 'Juicy beef patty with cheese, lettuce, tomato, and special sauce',
                'price' => 5.99,
                'category' => 'Burgers',
                'image' => null,
                'is_available' => true,
            ],
            [
                'name' => 'BBQ Chicken Pizza',
                'description' => 'Grilled chicken with tangy BBQ sauce and melted cheese',
                'price' => 9.99,
                'category' => 'Pizzas',
                'image' => null,
                'is_available' => true,
            ],
            [
                'name' => 'Caesar Salad',
                'description' => 'Fresh romaine lettuce with Caesar dressing, croutons, and parmesan',
                'price' => 4.99,
                'category' => 'Salads',
                'image' => null,
                'is_available' => true,
            ],
            [
                'name' => 'Fish and Chips',
                'description' => 'Crispy battered fish with golden fries and tartar sauce',
                'price' => 7.99,
                'category' => 'Mains',
                'image' => null,
                'is_available' => true,
            ],
            [
                'name' => 'Chocolate Brownie',
                'description' => 'Rich and fudgy chocolate brownie with vanilla ice cream',
                'price' => 3.49,
                'category' => 'Desserts',
                'image' => null,
                'is_available' => true,
            ],
            [
                'name' => 'Coca Cola',
                'description' => 'Chilled refreshing drink',
                'price' => 1.99,
                'category' => 'Drinks',
                'image' => null,
                'is_available' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}