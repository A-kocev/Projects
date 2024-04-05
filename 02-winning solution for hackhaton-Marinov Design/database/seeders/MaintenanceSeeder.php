<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Maintenance;

class MaintenanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Maintenance::create([
            'title' => 'Regular Dusting',
            'description' => 'Wipe with a soft, lint-free cloth to prevent buildup.',
        ]);

        Maintenance::create([
            'title' => 'Gentle Cleaning',
            'description' => 'Use mild soap and warm water; avoid abrasive tools.',
        ]);

        Maintenance::create([
            'title' => 'Avoid Moisture',
            'description' => 'Dry thoroughly after exposure to water.',
        ]);

        Maintenance::create([
            'title' => 'Storage',
            'description' => 'Store in a cool, dry place; wrap to prevent scratches.',
        ]);

        Maintenance::create([
            'title' => 'No Harsh Chemicals',
            'description' => 'Avoid bleach and abrasive cleaners.',
        ]);
    }
}
