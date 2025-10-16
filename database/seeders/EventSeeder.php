<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\User;
use App\Models\Pet;

class EventSeeder extends Seeder
{
    public function run()
    {
        // Ensure we have at least one admin and one user
        $admin = User::where('role', 'admin')->first();
        $user = User::where('role', 'user')->first();
        $pet = Pet::where('user_id', $user->id)->first(); // get John's registered pet

        // Create sample event
        $event = Event::create([
            'user_id' => $admin->id,
            'title' => 'Annual Pet Adoption Fair',
            'description' => 'Join us for the annual adoption fair! Meet adorable pets and learn about responsible pet ownership.',
            'event_date' => now()->addDays(7)->setTime(9, 0),
            'location' => 'CityVet Clinic, 123 Main Street',
        ]);

        // Register user’s pet for the event (if available)
        if ($pet) {
            EventRegistration::create([
                'event_id' => $event->id,
                'user_id' => $user->id,
                'pet_id' => $pet->id,
            ]);
        }

        // Another sample event
        Event::create([
            'user_id' => $admin->id,
            'title' => 'Free Vaccination Drive',
            'description' => 'Free anti-rabies and 5-in-1 vaccines for pets. Bring your registration card!',
            'event_date' => now()->addDays(14)->setTime(8, 30),
            'location' => 'Barangay Hall Covered Court',
        ]);

        // Upcoming event
        Event::create([
            'user_id' => $admin->id,
            'title' => 'Responsible Pet Ownership Seminar',
            'description' => 'A short seminar to educate pet owners about proper pet care and laws.',
            'event_date' => now()->addDays(21)->setTime(13, 0),
            'location' => 'CityVet Function Hall',
        ]);
    }
}
