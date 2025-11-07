<?php

namespace Database\Seeders;

use App\Models\Pet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 impounded pets
        Pet::factory()->count(10)->create([
            'status' => 'impounded',
        ]);

        // Create 15 adoptable pets
        Pet::factory()->count(15)->create([
            'status' => 'adoptable',
        ]);

        // Create 5 registered pets
        Pet::factory()->count(5)->create([
            'status' => 'registered',
        ]);
    }
}
