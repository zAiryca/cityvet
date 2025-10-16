<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    protected $hidden = ['password', 'remember_token'];

    // Relationships
    public function pets()
    {
        return $this->hasMany(Pet::class);
    }

    public function posters()
    {
        return $this->hasMany(Poster::class);
    }

    public function requests()
    {
        return $this->hasMany(PetRequest::class, 'user_id');  // As requester
    }

    public function createdEvents()
    {
        return $this->hasMany(Event::class);
    }

    public function eventRegistrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    // Check if admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
