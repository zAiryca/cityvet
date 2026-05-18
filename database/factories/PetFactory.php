<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $species = $this->faker->randomElement(['Feline', 'Canine']);
        return [
            'name' => $this->faker->firstName,
            'species' => $species,
            'breed' => $this->faker->randomElement($this->getBreedsForSpecies($species)),
            'estimated_age_years' => $this->faker->numberBetween(0, 10),
            'estimated_age_months' => $this->faker->numberBetween(0, 11),
            'gender' => $this->faker->randomElement(['male', 'female', 'unknown']),
            'color_markings' => implode(',', $this->faker->randomElements(['Black', 'White', 'Brown', 'Gray', 'Orange'], $this->faker->numberBetween(1, 3))),
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['impounded', 'adoptable', 'adopted', 'claimed']),
            'photo' => null,
            'registration_status' => $this->faker->randomElement(['pre-registered', 'approved', 'denied']),
            'admin_notes' => $this->faker->optional(0.5)->paragraph,
            'impounded_date' => $this->faker->optional(0.3, null)->dateTimeBetween('-1 month', 'now')?->format('Y-m-d'), // 30% chance
            'caught_location' => $this->faker->optional(0.3, null)->address, // 30% chance
            'decision_date' => $this->faker->optional(0.2, null)->dateTimeBetween('-1 month', 'now')?->format('Y-m-d'), // 20% chance
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }

    private function getBreedsForSpecies($species)
    {
        $breeds = [
            'Feline' => [
                'Persian', 'Siamese', 'Maine Coon', 'British Shorthair', 'Ragdoll',
                'Abyssinian', 'Bengal', 'Sphynx', 'Russian Blue', 'American Shorthair'
            ],
            'Canine' => [
                'Labrador Retriever', 'German Shepherd', 'Golden Retriever', 'Bulldog',
                'Beagle', 'Poodle', 'Rottweiler', 'Yorkshire Terrier', 'Boxer', 'Dachshund',
                'Siberian Husky', 'Great Dane', 'Chihuahua', 'Pug', 'Shih Tzu'
            ]
        ];

        return $breeds[$species] ?? [];
    }
}
