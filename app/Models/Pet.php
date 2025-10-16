<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $fillable = [
        'user_id', 'name', 'species', 'breed', 'gender', 'color_markings',
        'description', 'photo', 'status', 'impounded_date', 'remaining_days', 'urgent_deadline',
    ];

    // Cast dates
    protected $casts = [
        'impounded_date' => 'date',
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
