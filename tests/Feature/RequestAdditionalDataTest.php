<?php

namespace Tests\Feature;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RequestAdditionalDataTest extends TestCase
{
    use RefreshDatabase;

    public function test_request_additional_data_is_saved_and_shown_over_profile_values(): void
    {
        // Create a user with profile values
        $user = User::factory()->create([
            'first_name' => 'ProfileFirst',
            'last_name' => 'ProfileLast',
            'contact_number' => '09120000000',
            'email' => 'profile@example.com',
            'birthday' => '2000-01-01',
        ]);

        // Create an adoptable pet
        $pet = Pet::factory()->create(['status' => 'adoptable']);

        // Form-submitted values (intentionally different from profile)
        $form = [
            'type' => 'adopt',
            'first_name' => 'FormFirst',
            'last_name' => 'FormLast',
            'middle_name' => 'Q',
            'address' => '123 Form St, Barangay, City',
            'contact_number' => '09119998877',
            'email' => 'form@example.com',
            'date_of_birth' => '1990-03-21',
            'dwelling_type' => 'owned',
            'fenced_property' => 'yes',
            'adults_count' => 2,
            'children_count' => 0,
            'allergies' => 'no',
            'other_pets' => 'no',
            'pet_living_area' => 'indoors',
            'reason' => 'I have a loving home',
            'certify_info' => '1',
            'agree_terms' => '1',
        ];

        // Submit the adoption request as the user
        $this->actingAs($user)
            ->post(route('pets.request', $pet), $form)
            ->assertSessionHas('success');

        // Retrieve the created pet request
        $petRequest = $pet->requests()->where('user_id', $user->id)->first();
        $this->assertNotNull($petRequest, 'PetRequest was not created');

        $additional = is_array($petRequest->additional_data) ? $petRequest->additional_data : json_decode($petRequest->additional_data, true);

        // Assert additional_data contains the submitted form values, not the profile values
        $this->assertSame('FormFirst', $additional['first_name']);
        $this->assertSame('FormLast', $additional['last_name']);
        $this->assertSame('09119998877', $additional['contact_number']);
        $this->assertSame('form@example.com', $additional['email']);
        $this->assertSame('1990-03-21', $additional['date_of_birth']);

        // Request show page should display form-submitted values and not the profile values
        $response = $this->actingAs($user)->get(route('user.requests.show', $petRequest));
        $response->assertOk();
        $response->assertSee('FormFirst');
        $response->assertSee('FormLast');
        $response->assertSee('09119998877');
        $response->assertSee('form@example.com');
        $response->assertSee('Mar 21, 1990'); // formatted DOB

        // And ensure profile values do not appear in the request details
        $response->assertDontSee('ProfileFirst');
        $response->assertDontSee('ProfileLast');
        $response->assertDontSee('profile@example.com');
    }
}
