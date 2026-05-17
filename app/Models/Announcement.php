<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'category', 'description', 'date_when', 'location', 'photo'];

    protected $casts = [
        // 'date_when' => 'datetime', // Keep as string for flexibility
    ];

    // Relationship with photos
    public function photos()
    {
        return $this->hasMany(AnnouncementPhoto::class)->orderBy('order', 'asc');
    }

    // Scope for upcoming events
    public function scopeUpcoming($query)
    {
        return $query->where('date_when', '>=', now())->orderBy('date_when', 'asc');
    }

    // No registration relationship needed - announcements are for viewing only

}
