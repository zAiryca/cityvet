<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Pet;
use App\Models\Poster;
use App\Models\Event;
use App\Models\PetRequest;
use App\Models\EventRegistration;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UserSeeder::class); // Creates admin (ID 1) and John Doe (ID 2)
        // Only seed users, let admin add other data manually
    }
}
