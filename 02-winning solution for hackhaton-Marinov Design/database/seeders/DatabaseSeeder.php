<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            CategorySeeder::class,
            MaintenanceSeeder::class,
            MaterialSeeder::class,
            TypeSeeder::class,
            ProductSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            FaqSeeder::class,
            ImageSeeder::class,
            GalleriesSeeder::class,
            DiscountSeeder::class,
            GiftCardSeeder::class,
        ]);
    }   
}
