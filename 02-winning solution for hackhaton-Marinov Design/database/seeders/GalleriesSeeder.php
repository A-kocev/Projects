<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery;
use Faker\Factory as Faker;

class GalleriesSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            Gallery::create([
                'images' => $faker->imageUrl($width = 640, $height = 480),
            ]);
        }
    }
}
