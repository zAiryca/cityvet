<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name', 'middle_name', 'last_name', 'gender', 'birthday', 'contact_number', 'emergency_contact', 'street', 'barangay', 'city_municipality', 'province', 'zip_code', 'email', 'password', 'role', 'id_photo',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthday' => 'date',
    ];

    /**
     * Get the user's email in lowercase.
     */
    protected function email(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtolower($value),
        );
    }

    // Relationships
    public function pets()
    {
        return $this->hasMany(Pet::class)->where('status', 'registered');
    }

    public function posters()
    {
        return $this->hasMany(Poster::class);
    }

    public function requests()
    {
        return $this->hasMany(PetRequest::class, 'user_id');  // As requester
    }

    public function petRegistrations()
    {
        return $this->hasMany(PetRegistration::class);
    }

    // Check if admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
