<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            'Pinc Partywear',
            'Factory Girl',
            'Main Days',
            'Fracil',
            'Urma',
            'Candle Nest',
            'Beyound Green',
            'Gatta'

        ];
        $categories = Category::all()->pluck('id')->toArray();
        foreach ($brands as $brand) {
            $insertedBrand = Brand::create([
                'name' => $brand,
                'description' => fake()->paragraph,
                'status' => 1
            ]);
            DB::table('brand_category')->insert([
                'brand_id' => $insertedBrand->id,
                'category_id' => Arr::random($categories)
            ]);
        }
    }
}
