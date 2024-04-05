<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            'Pinc Partywear фустан',
            'Зелена кратка блуза',
            'Puffer кратка јакна',
            'Nightout фустан',
            'URMA фрижидерче за козметика',
        ];
        $brands = Brand::all();
        // $categories = Category::all();
        $discounts = Discount::all()->pluck('id')->toArray();
        for ($i = 0; $i < 3; $i++) {
            foreach ($products as $product) {
                $randomBrand = $brands->random();
                $randomCategory = $randomBrand->categories->random();
                Product::create([
                    'name' => $product,
                    'price' => rand(500, 5000),
                    'description' => fake()->paragraph,
                    'quantity' => rand(0, 100),
                    'size_hint' => fake()->paragraph,
                    'maintenance_guidelines' => fake()->paragraph,
                    'brand_id' => $randomBrand->id,
                    'category_id' =>  $randomCategory->id,
                    'discount_id' => Arr::random($discounts),
                    'status' => 1,
                ]);
            }
        }
    }
}
