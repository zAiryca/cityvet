<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $category
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property string|null $date_when
 * @property string|null $location
 * @property string|null $published_at
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Announcement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Announcement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Announcement query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Announcement upcoming()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Announcement whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Announcement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Announcement whereDateWhen($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Announcement whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Announcement whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Announcement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Announcement whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Announcement wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Announcement whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Announcement whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Announcement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Announcement whereUserId($value)
 */
	class Announcement extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int|null $user_id
 * @property string $name
 * @property string $species
 * @property string $breed
 * @property \Illuminate\Support\Carbon $birth_date
 * @property string $gender
 * @property string $color_markings
 * @property string|null $description
 * @property string|null $photo
 * @property string $status
 * @property string $registration_status
 * @property string|null $admin_notes
 * @property \Illuminate\Support\Carbon|null $impounded_date
 * @property string|null $caught_location
 * @property \Illuminate\Support\Carbon|null $urgent_deadline
 * @property \Illuminate\Support\Carbon|null $decision_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $display_pet_id
 * @property-read mixed $remaining_days
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PetRequest> $requests
 * @property-read int|null $requests_count
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\PetFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereAdminNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereBreed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereCaughtLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereColorMarkings($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereDecisionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereImpoundedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereRegistrationStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereSpecies($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereUrgentDeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereUserId($value)
 */
	class Pet extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property int|null $requestable_id
 * @property string|null $requestable_type
 * @property string $type
 * @property string $status
 * @property string $reason
 * @property string $contact_info
 * @property string|null $admin_notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $photos
 * @property string|null $additional_data
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent|null $requestable
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRequest whereAdditionalData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRequest whereAdminNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRequest whereContactInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRequest whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRequest wherePhotos($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRequest whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRequest whereRequestableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRequest whereRequestableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRequest whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRequest whereUserId($value)
 */
	class PetRequest extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property string|null $pet_name
 * @property string $species
 * @property string $breed
 * @property string $gender
 * @property string $color_markings
 * @property string|null $description
 * @property \Illuminate\Support\Carbon $date_lost_found
 * @property string|null $last_seen
 * @property string|null $found_at
 * @property string $photo
 * @property string $contact_info
 * @property numeric|null $reward
 * @property int $approved
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $display_poster_id
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Poster newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Poster newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Poster query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Poster whereApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Poster whereBreed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Poster whereColorMarkings($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Poster whereContactInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Poster whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Poster whereDateLostFound($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Poster whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Poster whereFoundAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Poster whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Poster whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Poster whereLastSeen($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Poster wherePetName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Poster wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Poster whereReward($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Poster whereSpecies($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Poster whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Poster whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Poster whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Poster whereUserId($value)
 */
	class Poster extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $first_name
 * @property string|null $middle_name
 * @property string $last_name
 * @property string|null $contact_number
 * @property string|null $emergency_contact
 * @property string|null $street
 * @property string|null $zip_code
 * @property string|null $barangay
 * @property string|null $city_municipality
 * @property string|null $province
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string $role
 * @property bool $terms
 * @property bool $privacy
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $first_name_lower
 * @property string|null $last_name_lower
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pet> $adoptedPets
 * @property-read int|null $adopted_pets_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pet> $claimedPets
 * @property-read int|null $claimed_pets_count
 * @property-read string $name
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pet> $pets
 * @property-read int|null $pets_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Poster> $posters
 * @property-read int|null $posters_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PetRequest> $requests
 * @property-read int|null $requests_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereBarangay($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCityMunicipality($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereContactNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmergencyContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereFirstNameLower($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLastNameLower($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePrivacy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTerms($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereZipCode($value)
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

