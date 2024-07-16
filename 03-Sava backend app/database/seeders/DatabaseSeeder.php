<?php

namespace Database\Seeders;

use App\Models\Policy;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserTableSeeder::class,
            InvoiceSeeder::class,
            PolicySeeder::class,
            DamageSeeder::class,
        ]);
    }
}
