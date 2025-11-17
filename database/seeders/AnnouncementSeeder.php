<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Announcement;

class AnnouncementSeeder extends Seeder
{
    public function run()
    {
        Announcement::create([
            'title' => '🐾 Free Microchipping Clinic This Weekend',
            'description' => 'Visit our main clinic Saturday morning for free microchipping services. First-come, first-served. Registration not required.',
            'category' => 'Event',
            'date_when' => 'Saturday, Nov 16th, 9:00 AM',
            'location' => 'CityVet Main Clinic, Zone 3',
            'user_id' => 1,
        ]);

        Announcement::create([
            'title' => '🧠 Did You Know? Cat Noses',
            'description' => 'A cat\'s nose print is unique, much like a human fingerprint! We recommend documenting your pet\'s nose print!',
            'category' => 'Trivia',
            'date_when' => 'Posted Today',
            'location' => 'Online Fact Sheet',
            'user_id' => 1,
        ]);

        Announcement::create([
            'title' => '🗓️ Revised Christmas Eve Hours',
            'description' => 'All clinic branches will close at 12 PM on December 24th and remain closed on December 25th. Check the full holiday schedule online.',
            'category' => 'Holiday Notice',
            'date_when' => 'December 24th',
            'location' => 'All Clinic Branches',
            'user_id' => 1,
        ]);

        Announcement::create([
            'title' => '🤯 Fun Fact: Dogs Can See in Color!',
            'description' => 'Contrary to popular belief, dogs don\'t just see black and white. They see the world in blues and yellows! Learn more on our resources page.',
            'category' => 'Fun Fact',
            'date_when' => 'Daily Post',
            'location' => 'Online Resources',
            'user_id' => 1,
        ]);
    }
}
