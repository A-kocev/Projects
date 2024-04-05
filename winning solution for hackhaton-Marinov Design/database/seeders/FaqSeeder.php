<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faq::create([
            'question' => 'Do you ship worldwide?',
            'answer' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure cumque dicta veniam sed sit minima.'
        ]);

        Faq::create([
            'question' => 'Is copper jewerly safe to wear?',
            'answer' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure cumque dicta veniam sed sit minima.'
        ]);
    }
}
