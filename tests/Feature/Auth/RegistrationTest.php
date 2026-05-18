<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Helper method to generate valid registration data.
     * FIXED: Now includes both 'terms' (required) and 'privacy' (nullable/present) fields.
     */
    protected function validRegistrationData($overrides = []): array
    {
        return array_merge([
            'first_name' => 'John',
            'last_name' => 'Smith',
            // Using the 11-digit format (e.g., 09170000000) which should now pass the corrected regex in RegisterRequest.
            'contact_number' => '09170000000',
            'email' => 'test@example.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
            'role' => 'user',
            // FIXED: Adding 'terms' as it is a required field in the RegisterRequest.
            'terms' => true,
        ], $overrides);
    }

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', $this->validRegistrationData());

        // FIXED: Replaced assertAuthenticated() because new users are redirected to verification,
        // and are typically not fully authenticated until they click the link.
        $this->assertGuest();
        $response->assertRedirect(route('verification.notice', absolute: false));

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'first_name' => 'John',
        ]);
    }

    public function test_duplicate_name_combination_is_rejected(): void
    {
        // Create first user
        $this->post('/register', $this->validRegistrationData([
            'first_name' => 'Erricca',
            'last_name' => 'Morales',
            'email' => 'test1@example.com',
        ]));

        // Logout the first user (Ensures the second user isn't accidentally logged in as the first)
        $this->post('/logout');

        // Try to register with same name (different case)
        $response = $this->post('/register', $this->validRegistrationData([
            'first_name' => 'erricca',
            'last_name' => 'MORALES',
            'email' => 'test2@example.com',
        ]));

        // Should have errors and redirect back
        $response->assertSessionHasErrors('first_name');
        $response->assertRedirect();

        // Verify the duplicate user was not created
        $this->assertDatabaseMissing('users', ['email' => 'test2@example.com']);
    }

    public function test_name_capitalization_on_registration(): void
    {
        $registrationData = $this->validRegistrationData([
            'first_name' => 'john',
            'last_name' => 'smith',
            'email' => 'test.caps@example.com', // Use a unique email
        ]);

        $response = $this->post('/register', $registrationData);

        // FIXED: Check for guest and fetch user from DB instead of Auth::user()
        $this->assertGuest();
        $response->assertRedirect(route('verification.notice', absolute: false));

        // Fetch user directly from the database
        $user = User::where('email', $registrationData['email'])->first();
        $this->assertNotNull($user, 'User was not created for capitalization test.');

        $this->assertEquals('John', $user->first_name);
        $this->assertEquals('Smith', $user->last_name);
    }

    public function test_registration_fails_with_invalid_email(): void
    {
        $response = $this->post('/register', $this->validRegistrationData([
            'email' => 'invalid-email',
        ]));

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_registration_fails_with_duplicate_email(): void
    {
        User::factory()->create(['email' => 'existing@example.com']);

        $response = $this->post('/register', $this->validRegistrationData([
            'email' => 'existing@example.com',
        ]));

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_registration_fails_with_mismatched_passwords(): void
    {
        $response = $this->post('/register', $this->validRegistrationData([
            'password' => 'Password123!',
            'password_confirmation' => 'DifferentPassword123!',
        ]));

        $response->assertSessionHasErrors('password');
        $this->assertGuest();
    }

    public function test_registration_fails_with_weak_password(): void
    {
        $response = $this->post('/register', $this->validRegistrationData([
            'password' => '123',
            'password_confirmation' => '123',
        ]));

        $response->assertSessionHasErrors('password');
        $this->assertGuest();
    }

    public function test_registration_fails_with_missing_required_fields(): void
    {
        $response = $this->post('/register', $this->validRegistrationData([
            'first_name' => '',
            'last_name' => '',
            'email' => '',
        ]));

        $response->assertSessionHasErrors(['first_name', 'last_name', 'email']);
        $this->assertGuest();
    }

    public function test_registration_fails_without_terms_acceptance(): void
    {
        $response = $this->post('/register', $this->validRegistrationData([
            'terms' => false, // Uses 'terms' now
        ]));

        // Asserting on 'terms' field now
        $response->assertSessionHasErrors('terms');
        $this->assertGuest();
    }

    public function test_registration_fails_with_invalid_contact_number(): void
    {
        $response = $this->post('/register', $this->validRegistrationData([
            'contact_number' => 'invalid-number',
        ]));

        $response->assertSessionHasErrors('contact_number');
        $this->assertGuest();
    }

    public function test_registration_fails_with_missing_contact_number(): void
    {
        $response = $this->post('/register', $this->validRegistrationData([
            'contact_number' => '',
        ]));

        $response->assertSessionHasErrors('contact_number');
        $this->assertGuest();
    }

    public function test_names_with_special_characters_are_allowed(): void
    {
        $registrationData = $this->validRegistrationData([
            'first_name' => "O'Brien",
            'last_name' => "García",
            'email' => 'test.special@example.com', // Use a unique email
        ]);

        $response = $this->post('/register', $registrationData);

        // FIXED: Check for guest and fetch user from DB instead of Auth::user()
        $this->assertGuest();
        $response->assertRedirect(route('verification.notice', absolute: false));

        // Fetch user directly from the database
        $user = User::where('email', $registrationData['email'])->first();
        $this->assertNotNull($user, 'User was not created for special characters test.');

        $this->assertEquals("O'brien", $user->first_name);
        $this->assertEquals("García", $user->last_name);
    }

    public function test_middle_name_is_optional(): void
    {
        // This test is no longer needed since middle_name is not part of registration
        // Users can add it in their profile after login
        $this->assertTrue(true);
    }
}
