<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    private $barangays = [
        "Alos", "Palamis", "Amandiego", "Pandan", "Amangbangan", "Pangapisan", "Balangobong", "Poblacion", "Balayang", "Pocal-pocal",
        "Baleyadaan", "Pogo", "Bisocol", "Polo", "Bolaney", "Quibuar", "Bued", "Sabangan", "Cabatuan", "San Antonio",
        "Cayucay", "San Jose", "Dulacac", "San Roque", "Inerangan", "San Vicente", "Landoc", "Sta Maria", "Linmansangan", "Tanaytay",
        "Lucap", "Tangcarang", "Maawi", "Tawin-tawin", "Macatiw", "Telbang", "Magsaysay", "Victoria", "Mona"
    ];

    private $emailDomains = ['gmail.com', 'yahoo.com', 'outlook.com', 'hotmail.com', 'icloud.com', 'protonmail.com', 'mail.com'];

    public function run()
    {
        // Admin Account
        User::create([
            'first_name' => 'Admin',
            'middle_name' => null,
            'last_name' => 'CityVet',
            'contact_number' => '09123456789',
            'street' => 'CityVet Veterinary Clinic',
            'barangay' => 'Poblacion',
            'city_municipality' => 'Alaminos City',
            'province' => 'Pangasinan',
            'birthday' => '1985-05-15',
            'email' => 'acp.cityvet@gmail.com',
            'password' => Hash::make('Accvet234'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // 🇵🇭 Female Users (5) with Filipino Names
        $femaleNames = [
            ['first' => 'Maria', 'middle' => 'Cruz', 'last' => 'Santos'],
            ['first' => 'Rosa', 'middle' => 'Fernandez', 'last' => 'Garcia'],
            ['first' => 'Angelica', 'middle' => 'Reyes', 'last' => 'Morales'],
            ['first' => 'Diana', 'middle' => 'Villanueva', 'last' => 'Lopez'],
            ['first' => 'Carmen', 'middle' => 'Ramos', 'last' => 'De los Santos'],
        ];

        foreach ($femaleNames as $index => $name) {
            $domain = $this->emailDomains[$index % count($this->emailDomains)];
            $email = strtolower($name['first'] . '.' . $name['last']) . '@' . $domain;
            $barangay = $this->barangays[$index % count($this->barangays)];

            User::create([
                'first_name' => $name['first'],
                'middle_name' => $name['middle'],
                'last_name' => $name['last'],
                'contact_number' => '0917' . str_pad($index + 1, 7, '0', STR_PAD_LEFT),
                'street' => str_pad($index + 1, 3, '0', STR_PAD_LEFT) . ' Sampaguita Street',
                'barangay' => $barangay,
                'city_municipality' => 'Alaminos City',
                'province' => 'Pangasinan',
                'birthday' => now()->subYears(rand(18, 50))->subMonths(rand(0, 11))->subDays(rand(0, 28)),
                'email' => $email,
                'password' => Hash::make('Password123!'),
                'role' => 'user',
                'email_verified_at' => now(),
            ]);
        }

        // 🇵🇭 Male Users (6) with Filipino Names
        $maleNames = [
            ['first' => 'Juan', 'middle' => 'Dela Cruz', 'last' => 'Martinez'],
            ['first' => 'Pedro', 'middle' => 'Aquino', 'last' => 'Rizal'],
            ['first' => 'Francisco', 'middle' => 'Bonifacio', 'last' => 'Agoncillo'],
            ['first' => 'Manuel', 'middle' => 'Luis', 'last' => 'Espinosa'],
            ['first' => 'Ricardo', 'middle' => 'Laurel', 'last' => 'Jacinto'],
            ['first' => 'Antonio', 'middle' => 'Gonzales', 'last' => 'Hernandez'],
        ];

        foreach ($maleNames as $index => $name) {
            $domain = $this->emailDomains[($index + 5) % count($this->emailDomains)];
            $email = strtolower($name['first'] . '.' . $name['last']) . '@' . $domain;
            $barangay = $this->barangays[($index + 5) % count($this->barangays)];

            User::create([
                'first_name' => $name['first'],
                'middle_name' => $name['middle'],
                'last_name' => $name['last'],
                'contact_number' => '0917' . str_pad($index + 6, 7, '0', STR_PAD_LEFT),
                'street' => str_pad($index + 100, 3, '0', STR_PAD_LEFT) . ' Lapu-Lapu Street',
                'barangay' => $barangay,
                'city_municipality' => 'Alaminos City',
                'province' => 'Pangasinan',
                'birthday' => now()->subYears(rand(18, 50))->subMonths(rand(0, 11))->subDays(rand(0, 28)),
                'email' => $email,
                'password' => Hash::make('Password123!'),
                'role' => 'user',
                'email_verified_at' => now(),
            ]);
        }
    }
}
