<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PetRequest;

class PetRequestSeeder extends Seeder
{
    public function run()
    {
        PetRequest::create([
            'user_id' => 2, // Dummy User
            'pet_id' => 1, // First pet
            'request_type' => 'adoption',
            'status' => 'pending',
            'reason' => 'I have a loving home and experience with pets.',
            'additional_info' => 'I work from home and can provide constant care.',
        ]);

        PetRequest::create([
            'user_id' => 2,
            'pet_id' => 2,
            'request_type' => 'adoption',
            'status' => 'approved',
            'reason' => 'Looking for a companion for my other dog.',
            'additional_info' => 'Have a fenced yard and plenty of space.',
        ]);

        PetRequest::create([
            'user_id' => 3, // We'll add a third user
            'pet_id' => 3,
            'request_type' => 'claim',
            'status' => 'pending',
            'reason' => 'This is my lost cat that ran away last week.',
            'additional_info' => 'I have photos and vet records to prove ownership.',
        ]);
    }
}
