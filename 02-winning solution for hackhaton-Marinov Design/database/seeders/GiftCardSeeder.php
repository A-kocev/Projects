<?php

namespace Database\Seeders;

use App\Models\GiftCard;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GiftCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=0;$i <= 10;$i++){
            GiftCard::create([
                'card_code' => Str::random(10),
                'amount' => rand(5,100),
            ]);
        }
    }
}
