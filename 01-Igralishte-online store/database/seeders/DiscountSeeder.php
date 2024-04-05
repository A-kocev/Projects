<?php

namespace Database\Seeders;

use App\Models\Discount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $discounts = [
            'Spring 0523',
            'Summer 0723',
            'Autumn 0923',
            'Winter 0124'
        ];
        foreach($discounts as $discount){
            Discount::create([
                'name' => $discount,
                'percentage' => rand(5,30),
                'status' => 1,
            ]);
        }
    }
}
