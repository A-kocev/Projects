<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Policy;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $user_ids = User::all()->pluck('id');
        $invoice_ids = Invoice::all()->pluck('id');
        for ($i = 0; $i < 10; $i++) {
            $startDate = $faker->dateTimeBetween('-3 years', '-1 years');
            $expirationDate = $faker->dateTimeBetween('-1 year', '+3 years');
            $isActive = Carbon::now()->lt(Carbon::parse($expirationDate)) ? 1 : 0;

            Policy::create([
                'type' => $faker->randomElement(['Bike Insurance', 'Car Insurance', 'Travel Insurance']),
                'policy_number' => $faker->unique()->randomNumber(5),
                'number_of_people' => $faker->numberBetween(1, 5),
                'start_date' => $startDate->format('Y-m-d'),
                'expiration_date' => $expirationDate->format('Y-m-d'),
                'price' => $faker->randomFloat(2, 1000, 10000),
                'user_id' => $user_ids->random(),
                'active' => $isActive,
                'invoice_id' => $invoice_ids->random()
            ]);
        }
    }
}
