<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin
        User::create([
            'first_name' => 'Admin',
            'middle_name' => null,
            'last_name' => 'CityVet',
            'contact_number' => null,
            'street' => null,
            'barangay' => null,
            'city_municipality' => null,
            'province' => null,
            'email' => 'admin@cityvet.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);


        User::create([
            'first_name' => 'John',
            'middle_name' => null,
            'last_name' => 'Doe',
            'contact_number' => null,
            'street' => null,
            'barangay' => null,
            'city_municipality' => null,
            'province' => null,
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);
    }
}
