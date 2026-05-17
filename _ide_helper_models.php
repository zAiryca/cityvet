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
 * @property string $title
 * @property string $description
 * @property string|null $photo
 * @property string $type
 * @property string $date_when
 * @property string|null $location
 * @property string|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $category
 * @property int|null $user_id
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Announcement wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Announcement wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Announcement whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Announcement whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Announcement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Announcement whereUserId($value)
 */
	class Announcement extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $announcement_id
 * @property string $photo_path
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Announcement $announcement
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnouncementPhoto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnouncementPhoto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnouncementPhoto query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnouncementPhoto whereAnnouncementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnouncementPhoto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnouncementPhoto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnouncementPhoto whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnouncementPhoto wherePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnouncementPhoto whereUpdatedAt($value)
 */
	class AnnouncementPhoto extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int|null $user_id
 * @property string|null $name
 * @property string $species
 * @property string $breed
 * @property string $gender
 * @property int|null $estimated_age_years
 * @property int|null $estimated_age_months
 * @property string $color_markings
 * @property string|null $description
 * @property string|null $photo
 * @property string|null $photos
 * @property string $status
 * @property string $registration_status
 * @property string|null $admin_notes
 * @property \Illuminate\Support\Carbon|null $impounded_date
 * @property string|null $caught_location
 * @property \Illuminate\Support\Carbon|null $decision_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $adoption_reason
 * @property string|null $adoption_notes
 * @property string|null $adoption_reason_other
 * @property-read mixed $display_code
 * @property-read mixed $estimated_age
 * @property-read mixed $remaining_days
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PetRequest> $requests
 * @property-read int|null $requests_count
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\PetFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet unadopted()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet unclaimed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet visibleToUsers()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereAdminNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereAdoptionNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereAdoptionReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereAdoptionReasonOther($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereBreed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereCaughtLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereColorMarkings($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereDecisionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereEstimatedAgeMonths($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereEstimatedAgeYears($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereImpoundedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet wherePhotos($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereRegistrationStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereSpecies($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pet whereUserId($value)
 */
	class Pet extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property string $pet_name
 * @property string $species
 * @property string $breed
 * @property \Illuminate\Support\Carbon|null $birthday
 * @property string $gender
 * @property array<array-key, mixed>|null $color_markings
 * @property string|null $description
 * @property string|null $photo
 * @property string $status
 * @property string|null $denial_reason
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $display_pet_id
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRegistration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRegistration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRegistration query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRegistration whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRegistration whereBreed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRegistration whereColorMarkings($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRegistration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRegistration whereDenialReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRegistration whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRegistration whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRegistration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRegistration wherePetName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRegistration wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRegistration whereSpecies($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRegistration whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRegistration whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRegistration whereUserId($value)
 */
	class PetRegistration extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property int|null $requestable_id
 * @property string|null $requestable_type
 * @property string $type
 * @property string|null $status
 * @property string|null $denial_reason Reason why request was denied
 * @property string|null $denial_type Type of denial: manual (admin) or automatic (system)
 * @property string $reason
 * @property string $contact_info
 * @property string|null $admin_notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property array<array-key, mixed>|null $photos
 * @property array<array-key, mixed>|null $additional_data
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRequest whereDenialReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PetRequest whereDenialType($value)
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
 * @property string|null $uploader_comments
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Poster whereUploaderComments($value)
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
 * @property string|null $gender
 * @property \Illuminate\Support\Carbon|null $birthday
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
 * @property int $terms
 * @property int $privacy
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $first_name_lower
 * @property string|null $last_name_lower
 * @property string|null $id_photo
 * @property-read string $name
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PetRegistration> $petRegistrations
 * @property-read int|null $pet_registrations_count
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCityMunicipality($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereContactNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmergencyContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereFirstNameLower($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIdPhoto($value)
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

