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
            'email' => 'findfurever87@gmail.com',
            'password' => Hash::make('Capstone2'),
            'role' => 'admin',
        ]);

        // User
        User::create([
            'first_name' => 'Dummy',
            'middle_name' => null,
            'last_name' => 'User',
            'contact_number' => null,
            'street' => null,
            'barangay' => null,
            'city_municipality' => null,
            'province' => null,
            'email' => 'dummyacc@gmail.com',
            'password' => Hash::make('Capstone2'),
            'role' => 'user',
        ]);

        // Additional User
        User::create([
            'first_name' => 'Jane',
            'middle_name' => null,
            'last_name' => 'Smith',
            'contact_number' => '09123456789',
            'street' => '123 Main St',
            'barangay' => 'Barangay 1',
            'city_municipality' => 'Sample City',
            'province' => 'Sample Province',
            'email' => 'jane@example.com',
            'password' => Hash::make('Capstone2'),
            'role' => 'user',
        ]);
    }
}
