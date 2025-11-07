<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name', 'middle_name', 'last_name', 'contact_number', 'emergency_contact', 'street', 'barangay', 'city_municipality', 'province', 'zip_code', 'email', 'password', 'role',
    ];

    protected $hidden = ['password', 'remember_token'];

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

    public function adoptedPets()
    {
        return $this->hasMany(Pet::class)->where('status', 'adopted');
    }

    public function claimedPets()
    {
        return $this->hasMany(Pet::class)->where('status', 'claimed');
    }

    public function createdEvents()
    {
        return $this->hasMany(Event::class);
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
