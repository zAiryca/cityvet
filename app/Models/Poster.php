<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    protected $fillable = [
        'user_id', 'type', 'pet_name', 'species', 'breed', 'gender', 'color_markings',
        'date_lost_found', 'last_seen', 'found_at', 'photo', 'photos', 'video', 'contact_info', 'reward', 'approved',
        'status', 'description', 'uploader_comments', 'location_details', 'social_media_links',
    ];

    protected $casts = [
        'date_lost_found' => 'date',
        'reward' => 'decimal:2',
        'photos' => 'array',
        'social_media_links' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPhotoSourcesAttribute()
    {
        if (!empty($this->photos) && is_array($this->photos)) {
            return $this->photos;
        }

        return $this->photo ? [$this->photo] : [];
    }

    public function getPrimaryPhotoAttribute()
    {
        return $this->photo_sources[0] ?? null;
    }
}
