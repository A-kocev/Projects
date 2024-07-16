<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Policy;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DamageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $policiesId = Policy::all()->pluck('id');

        foreach (range(1, 10) as $index) {
            DB::table('damages')->insert([
                'damage_number' => $faker->unique()->numerify('D-######/##'),
                'policy_id' => $policiesId->random(),
                'status' => $faker->randomElement(['побарано', 'процесира', 'одобрено', 'исплатено']),
            ]);
        }
    }
}
