<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Poster;

class PosterSeeder extends Seeder
{
    public function run()
    {
        Poster::create([
            'user_id' => 2, // Assuming John Doe (normal user)
            'type' => 'lost',
            'pet_name' => 'Buddy',
            'species' => 'Dog',
            'breed' => 'Golden Retriever',
            'gender' => 'male',
            'color_markings' => 'Golden fur with white chest spot',
            'date_lost_found' => '2025-10-01',
            'last_seen' => 'Near Central Park',
            'found_at' => null,
            'photo' => 'posters/buddy.jpg', // optional (use storage link if exists)
            'contact_info' => 'john@example.com / 09123456789',
            'reward' => 500.00,
            'approved' => true,
        ]);

        Poster::create([
            'user_id' => 1, // Admin
            'type' => 'found',
            'pet_name' => 'Whiskers',
            'species' => 'Cat',
            'breed' => 'Persian',
            'gender' => 'female',
            'color_markings' => 'White fur with gray tail',
            'date_lost_found' => '2025-09-28',
            'last_seen' => null,
            'found_at' => 'CityVet Shelter',
            'photo' => 'posters/whiskers.jpg',
            'contact_info' => 'admin@cityvet.com / 09987654321',
            'reward' => null,
            'approved' => true,
        ]);
    }
}
