<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin - Verified
        User::create([
            'first_name' => 'Admin',
            'middle_name' => null,
            'last_name' => 'CityVet',
            'contact_number' => '09123456789',
            'street' => 'CityVet Clinic',
            'barangay' => 'Barangay 1',
            'city_municipality' => 'City',
            'province' => 'Province',
            'email' => 'acp.cityvet@gmail.com',
            'password' => Hash::make('Accvet234'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Regular User
        User::create([
            'first_name' => 'Erricca',
            'middle_name' => null,
            'last_name' => 'Morales',
            'contact_number' => '09170000000',
            'street' => '456 Oak Ave',
            'barangay' => 'Barangay 2',
            'city_municipality' => 'Sample City',
            'province' => 'Sample Province',
            'email' => 'morales.erricca17@gmail.com',
            'password' => Hash::make('Capstone2'),
            'role' => 'user',
            'email_verified_at' => now(),
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
            'email_verified_at' => now(),
        ]);

        // Additional test user
        User::create([
            'first_name' => 'John',
            'middle_name' => 'Paul',
            'last_name' => 'O\'Brien',
            'contact_number' => '09987654321',
            'street' => '789 Pine Road',
            'barangay' => 'Barangay 3',
            'city_municipality' => 'Test City',
            'province' => 'Test Province',
            'email' => 'test@example.com',
            'password' => Hash::make('TestPass123'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);
    }
}
