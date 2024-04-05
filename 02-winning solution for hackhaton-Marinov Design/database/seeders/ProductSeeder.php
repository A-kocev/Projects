<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Product 1
        Product::create([
            'title' => 'Product 1',
            'description' => 'Description for Product 1',
            'price' => 19.99,
            'quantity' => 50,
            'category_id' => 1,
            'type_id' => 1,
            'discount' => 5,
            'is_featured' => true,
            'weight' => 1.5,
            'dimensions' => '10x5x2',
        ]);

        // Product 2
        Product::create([
            'title' => 'Product 2',
            'description' => 'Description for Product 2',
            'price' => 29.99,
            'quantity' => 30,
            'category_id' => 2,
            'type_id' => 2,
            'discount' => 0,
            'is_featured' => false,
            'weight' => 2.0,
            'dimensions' => '15x8x3',
        ]);

        // Product 3
        Product::create([
            'title' => 'Product 3',
            'description' => 'Description for Product 3',
            'price' => 39.99,
            'quantity' => 40,
            'category_id' => 1,
            'type_id' => 2,
            'discount' => 10,
            'is_featured' => true,
            'weight' => 1.8,
            'dimensions' => '12x6x3',
        ]);

        // Product 4
        Product::create([
            'title' => 'Product 4',
            'description' => 'Description for Product 4',
            'price' => 49.99,
            'quantity' => 25,
            'category_id' => 2,
            'type_id' => 1,
            'discount' => 8,
            'is_featured' => false,
            'weight' => 1.2,
            'dimensions' => '8x4x2',
        ]);

        // Product 5
        Product::create([
            'title' => 'Product 5',
            'description' => 'Description for Product 5',
            'price' => 59.99,
            'quantity' => 35,
            'category_id' => 1,
            'type_id' => 1,
            'discount' => 15,
            'is_featured' => true,
            'weight' => 2.2,
            'dimensions' => '14x7x4',
        ]);
    }
}
