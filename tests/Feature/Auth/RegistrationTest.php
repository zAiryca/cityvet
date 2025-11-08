<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'first_name' => 'Test',
            'middle_name' => null,
            'last_name' => 'User',
            'contact_number' => '09170000000',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'user',
            'terms' => true,
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }

    public function test_duplicate_name_combination_is_rejected(): void
    {
        // Create first user
        $this->post('/register', [
            'first_name' => 'Erricca',
            'middle_name' => null,
            'last_name' => 'Morales',
            'contact_number' => '09170000000',
            'email' => 'test1@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'user',
            'terms' => true,
        ]);

        // Try to register with same name (different case)
        $response = $this->post('/register', [
            'first_name' => 'erricca',
            'middle_name' => null,
            'last_name' => 'MORALES',
            'contact_number' => '09170000001',
            'email' => 'test2@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'user',
            'terms' => true,
        ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors('first_name');
    }

    public function test_different_middle_name_allows_registration(): void
    {
        // Create first user
        $this->post('/register', [
            'first_name' => 'Erricca',
            'middle_name' => null,
            'last_name' => 'Morales',
            'contact_number' => '09170000000',
            'email' => 'test1@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'user',
            'terms' => true,
        ]);

        // Register with same first/last but different middle name
        $response = $this->post('/register', [
            'first_name' => 'Erricca',
            'middle_name' => 'Marie',
            'last_name' => 'Morales',
            'contact_number' => '09170000001',
            'email' => 'test2@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'user',
            'terms' => true,
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }
}
