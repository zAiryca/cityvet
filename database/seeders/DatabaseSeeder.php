<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UserSeeder::class); // Creates admin (ID 1), Dummy User (ID 2), Jane Smith (ID 3)
    }
}
