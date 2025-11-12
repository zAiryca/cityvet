<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Pet;
use App\Models\Poster;
use App\Models\PetRequest;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UserSeeder::class); // Creates admin (ID 1), Dummy User (ID 2), Jane Smith (ID 3)
        $this->call(PetSeeder::class); // Creates 30 pets (10 impounded, 15 adoptable, 5 registered)
        $this->call(PosterSeeder::class); // Creates 3 posters
        $this->call(AnnouncementSeeder::class); // Creates 3 announcements
        $this->call(PetRequestSeeder::class); // Creates 3 pet requests
    }
}
