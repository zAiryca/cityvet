<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    protected function validRegistrationData($overrides = []): array
    {
        return array_merge([
            'first_name' => 'John',
            'middle_name' => 'Doe',
            'last_name' => 'Smith',
            'contact_number' => '09170000000',
            'email' => 'test@example.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
            'role' => 'user',
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

        $this->assertAuthenticated();
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

        // Logout the first user
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
        $response = $this->post('/register', $this->validRegistrationData([
            'first_name' => 'john',
            'middle_name' => 'doe',
            'last_name' => 'smith',
        ]));

        $this->assertAuthenticated();
        $response->assertRedirect(route('verification.notice', absolute: false));

        $user = Auth::user();
        $this->assertEquals('John', $user->first_name);
        $this->assertEquals('Doe', $user->middle_name);
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
            'terms' => false,
        ]));

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
        $response = $this->post('/register', $this->validRegistrationData([
            'first_name' => "O'Brien",
            'middle_name' => "Jean-Paul",
            'last_name' => "García",
        ]));

        $this->assertAuthenticated();
        $response->assertRedirect(route('verification.notice', absolute: false));

        $user = Auth::user();
        $this->assertEquals("O'brien", $user->first_name);
        $this->assertEquals("Jean-Paul", $user->middle_name); // Str::title() capitalizes each word after hyphens
        $this->assertEquals("García", $user->last_name);
    }

    public function test_middle_name_is_optional(): void
    {
        $response = $this->post('/register', $this->validRegistrationData([
            'middle_name' => '',
        ]));

        $this->assertAuthenticated();
        $response->assertRedirect(route('verification.notice', absolute: false));

        $user = Auth::user();
        $this->assertNull($user->middle_name);
    }
}
