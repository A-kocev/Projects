<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            ['darkorange', '#FF835E'],
            ['orange', '#FBC26C'],
            ['yellow', '#FCFF81'],
            ['lightgreen', '#B9E5A4'],
            ['skyblue', '#75D7F0'],
            ['pink', '#FFDBDB'],
            ['violet', '#EA97FF'],
            ['gray', '#D9D9D9'],
            ['white', '#FFFFFF'],
            ['black', '#232221']
        ];

        foreach ($colors as $color) {
            Color::create([
                'name' => $color[0],
                'hex_code' => $color[1]
            ]);
        }
    }
}
