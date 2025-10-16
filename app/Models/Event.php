<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'event_date', 'location'];

    protected $casts = [
        'event_date' => 'datetime',
    ];

    // Scope for upcoming events
    public function scopeUpcoming($query)
    {
        return $query->where('event_date', '>=', now())->orderBy('event_date', 'asc');
    }

    // 👇 Polymorphic relation
    public function requests()
    {
        return $this->morphMany(PetRequest::class, 'requestable');
    }
}
