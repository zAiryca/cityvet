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
            'requestable_id' => 1, // First pet
            'requestable_type' => 'App\Models\Pet',
            'type' => 'adopt',
            'status' => 'pending',
            'reason' => 'I have a loving home and experience with pets.',
            'contact_info' => '09170000000',
            'admin_notes' => 'I work from home and can provide constant care.',
        ]);

        PetRequest::create([
            'user_id' => 2,
            'requestable_id' => 2,
            'requestable_type' => 'App\Models\Pet',
            'type' => 'adopt',
            'status' => 'approved',
            'reason' => 'Looking for a companion for my other dog.',
            'contact_info' => '09170000000',
            'admin_notes' => 'Have a fenced yard and plenty of space.',
        ]);

        PetRequest::create([
            'user_id' => 3, // We'll add a third user
            'requestable_id' => 3,
            'requestable_type' => 'App\Models\Pet',
            'type' => 'claim',
            'status' => 'pending',
            'reason' => 'This is my lost cat that ran away last week.',
            'contact_info' => '09170000000',
            'admin_notes' => 'I have photos and vet records to prove ownership.',
        ]);
    }
}
