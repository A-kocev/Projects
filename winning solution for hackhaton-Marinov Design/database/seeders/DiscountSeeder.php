<?php

namespace Database\Seeders;

use App\Models\Discount;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=0;$i <= 10;$i++){
            Discount::create([
                'discount_code' => Str::random(10),
                'percentage' => rand(1,30),
            ]);
        }
    }
}
