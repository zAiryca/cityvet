<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/profile');

        $response->assertOk();
    }

    public function test_profile_information_can_be_updated(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'first_name' => 'Updated',
                'middle_name' => 'Middle',
                'last_name' => 'User',
                'gender' => 'male',
                'birthday' => '1990-01-01',
                'contact_number' => '09124567890',  // FIXED: 11 digits (09 + 9 digits)
                'emergency_contact' => '09876543210',  // FIXED: 11 digits (09 + 9 digits)
                'email' => 'updated@test.com',  // FIXED: Use a real domain
                'street' => '123 Main Street',
                'barangay' => 'Barangay 1',
                'city_municipality' => 'Dagupan',
                'province' => 'Pangasinan',
                'zip_code' => '2400',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $user->refresh();

        $this->assertSame('Updated', $user->first_name);
        $this->assertSame('updated@test.com', $user->email);
        $this->assertNull($user->email_verified_at);
    }

    public function test_email_verification_status_is_unchanged_when_the_email_address_is_unchanged(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'first_name' => $user->first_name,
                'middle_name' => $user->middle_name,
                'last_name' => $user->last_name,
                'gender' => $user->gender ?? 'male',
                'birthday' => $user->birthday ?? '1990-01-01',
                'contact_number' => $user->contact_number ?? '09123456789',
                'emergency_contact' => $user->emergency_contact ?? '09987654321',
                'email' => $user->email,
                'street' => $user->street ?? '123 Main Street',
                'barangay' => $user->barangay ?? 'Barangay 1',
                'city_municipality' => $user->city_municipality ?? 'Dagupan',
                'province' => $user->province ?? 'Pangasinan',
                'zip_code' => $user->zip_code ?? '2400',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $this->assertNotNull($user->refresh()->email_verified_at);
    }

    public function test_user_can_delete_their_account(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->delete('/profile', [
                'password' => 'password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');

        $this->assertGuest();
        $this->assertNull($user->fresh());
    }

    public function test_correct_password_must_be_provided_to_delete_account(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from('/profile')
            ->delete('/profile', [
                'password' => 'wrong-password',
            ]);

        $response
            ->assertSessionHasErrorsIn('userDeletion', 'password')
            ->assertRedirect('/profile');

        $this->assertNotNull($user->fresh());
    }
}
