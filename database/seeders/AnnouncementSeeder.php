<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Announcement;

class AnnouncementSeeder extends Seeder
{
    public function run()
    {
        Announcement::create([
            'title' => 'New Vaccination Program',
            'content' => 'We are excited to announce our new vaccination program for pets. All pets must be vaccinated to ensure their health and safety.',
            'published_at' => now(),
            'status' => 'published',
        ]);

        Announcement::create([
            'title' => 'Shelter Expansion',
            'content' => 'CityVet is expanding its shelter to accommodate more pets. We will be able to help more animals in need.',
            'published_at' => now(),
            'status' => 'published',
        ]);

        Announcement::create([
            'title' => 'Adoption Fee Waiver',
            'content' => 'For the month of December, we are waiving adoption fees for senior pets. Give a home to an older pet today!',
            'published_at' => now(),
            'status' => 'published',
        ]);
    }
}
