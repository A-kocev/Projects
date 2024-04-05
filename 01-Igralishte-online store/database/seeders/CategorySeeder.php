<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Блузи',
            'Панталони',
            'Здолништа / шорцеви',
            'Фустани',
            'Палта и јакни',
            'Долна облека',
        ];
        foreach ($categories as $category){
            Category::create([
                'name' => $category
            ]);
        }
    }
}
