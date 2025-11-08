<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'name', 'species', 'breed', 'birth_date', 'gender', 'color_markings',
        'description', 'photo', 'status', 'impounded_date', 'caught_location', 'decision_date', 'remaining_days', 'urgent_deadline',
        'registration_status', 'admin_notes',
    ];

    // Cast dates
    protected $casts = [
        'birth_date' => 'date',
        'impounded_date' => 'date',
        'decision_date' => 'date',
        'urgent_deadline' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function requests()
    // {
    //     return $this->hasMany(PetRequest::class);
    // }

    public function requests()
{
    return $this->morphMany(\App\Models\PetRequest::class, 'requestable');
}


    public function eventRegistrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    // Helper: Calculate remaining days (for impounded)
    public function getRemainingDaysAttribute()
    {
        if (!$this->impounded_date) return null;
        return max(0, 7 - now()->diffInDays($this->impounded_date));  // 7-day example
    }

    // Helper: Is urgent?
    public function isUrgent()
    {
        return $this->status === 'adoptable' && $this->urgent_deadline && now() < $this->urgent_deadline;
    }
}
