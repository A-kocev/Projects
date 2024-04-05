<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a user with the 'admin' role
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role_id' => Role::where('type', 'admin')->value('id'),
        ]);

        // Create a user with the 'super_admin' role
        User::create([
            'name' => 'Super Admin User',
            'email' => 'super_admin@example.com',
            'password' => Hash::make('password'),
            'role_id' => Role::where('type', 'super_admin')->value('id'),
        ]);
    }
}
