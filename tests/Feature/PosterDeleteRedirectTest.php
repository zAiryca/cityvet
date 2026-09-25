<?php

namespace Tests\Feature;

use App\Models\Poster;
use App\Models\User;
use Tests\TestCase;

class PosterDeleteRedirectTest extends TestCase
{
    public function test_user_delete_redirects_to_lost_and_found_index(): void
    {
        $user = User::factory()->create();

        $poster = Poster::create([
            'user_id' => $user->id,
            'type' => 'lost',
            'pet_name' => 'Buddy',
            'species' => 'Dog',
            'breed' => 'Labrador',
            'gender' => 'male',
            'date_lost_found' => now()->subDays(2)->toDateString(),
            'contact_info' => '09123456789',
            'approved' => true,
            'status' => 'active',
        ]);

        $this->actingAs($user)
            ->delete(route('posters.destroy', $poster))
            ->assertRedirect(route('posters.index'));

        $this->assertDatabaseMissing('posters', ['id' => $poster->id]);
    }
}
