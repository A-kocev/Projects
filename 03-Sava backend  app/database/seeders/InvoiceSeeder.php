<?php

namespace Database\Seeders;

use App\Models\Policy;
use App\Models\Invoice;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $policies = Policy::all();

        for ($i=0; $i<10; $i++) {
            Invoice::create([
                'invoice_number' => $faker->unique()->numerify('F-######/##'),
                'due_date' =>$faker->dateTimeBetween('tomorrow', '+1 years') ,
                'payment_method' => $faker->randomElement(['Credit Card', 'Bank Transfer', 'Cash']),
                'status' => $faker->randomElement(['pay now', 'paid'])
            ]);
        }
    }
}
