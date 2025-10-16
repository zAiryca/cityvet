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
        $this->call(EventSeeder::class); // Creates sample events
        $this->call(PosterSeeder::class); // Creates sample posters


        // --- Pets ---
        $impoundedPet = Pet::create([
            'user_id' => null,
            'name' => 'Buddy',
            'species' => 'Dog',
            'breed' => 'Labrador Retriever',
            'gender' => 'male',
            'color_markings' => 'Black with white chest',
            'description' => 'Friendly stray found by animal control. Healthy but needs home.',
            'photo' => 'https://via.placeholder.com/300x200?text=Impounded+Dog',
            'status' => 'impounded',
            'impounded_date' => now()->subDays(2),
        ]);

        $adoptablePet = Pet::create([
            'user_id' => null,
            'name' => 'Whiskers',
            'species' => 'Cat',
            'breed' => 'Domestic Shorthair',
            'gender' => 'female',
            'color_markings' => 'Gray tabby with white paws',
            'description' => 'Sweet cat ready for adoption. Urgent due to space.',
            'photo' => 'https://via.placeholder.com/300x200?text=Adoptable+Cat',
            'status' => 'adoptable',
            'impounded_date' => now()->subDays(8),
            'urgent_deadline' => now()->addDays(3),
        ]);

        $registeredPet = Pet::create([
            'user_id' => 2,
            'name' => 'Bella',
            'species' => 'Dog',
            'breed' => 'Beagle',
            'gender' => 'female',
            'color_markings' => 'Tri-color (brown, white, black)',
            'description' => 'My family pet, registered for events.',
            'photo' => 'https://via.placeholder.com/300x200?text=Registered+Dog',
            'status' => 'registered',
        ]);

        // --- Posters ---
        $lostPoster = Poster::create([
            'user_id' => 2,
            'type' => 'lost',
            'pet_name' => 'Max',
            'species' => 'Dog',
            'breed' => 'Golden Retriever',
            'gender' => 'male',
            'color_markings' => 'Golden fur with white markings',
            'date_lost_found' => now()->subDays(1),
            'last_seen' => 'Last seen at Central Park on 10/15/2024',
            'photo' => 'https://via.placeholder.com/300x200?text=Lost+Dog',
            'contact_info' => 'john@example.com | 555-123-4567',
            'reward' => 200.00,
            'approved' => true,
        ]);

        $foundPoster = Poster::create([
            'user_id' => 2,
            'type' => 'found',
            'pet_name' => 'Stray Kitty',
            'species' => 'Cat',
            'breed' => 'Unknown',
            'gender' => 'unknown',
            'color_markings' => 'Orange tabby',
            'date_lost_found' => now(),
            'found_at' => 'Found near the vet clinic today',
            'photo' => 'https://via.placeholder.com/300x200?text=Found+Cat',
            'contact_info' => 'john@example.com | 555-123-4567',
            'reward' => null,
            'approved' => false,
        ]);

        // --- Events ---
        $event = Event::create([
            'user_id' => 1,
            'title' => 'Annual Pet Adoption Fair',
            'description' => 'Come meet adoptable pets, enjoy free vet checkups, and learn about pet care.',
            'event_date' => now()->addDays(7)->setTime(10, 0),
            'location' => 'CityVet Clinic, 123 Main St, Anytown',
        ]);

        // --- Event Registration ---
        EventRegistration::create([
            'event_id' => $event->id,
            'pet_id' => $registeredPet->id,
            'user_id' => 2,
        ]);

        // --- Pet Requests (POLYMORPHIC) ---
        PetRequest::create([
            'requestable_id' => $impoundedPet->id,
            'requestable_type' => Pet::class,
            'user_id' => 2,
            'type' => 'claim',
            'status' => 'pending',
            'reason' => 'This is my missing dog Buddy! I have proof of ownership.',
            'contact_info' => 'john@example.com | 555-123-4567',
        ]);

        PetRequest::create([
            'requestable_id' => $adoptablePet->id,
            'requestable_type' => Pet::class,
            'user_id' => 2,
            'type' => 'adopt',
            'status' => 'approved',
            'reason' => 'I want to give this cat a loving home.',
            'contact_info' => 'john@example.com',
        ]);
    }
}
