<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    protected $fillable = [
        'user_id', 'type', 'pet_name', 'species', 'breed', 'gender', 'color_markings',
        'date_lost_found', 'last_seen', 'found_at', 'photo', 'contact_info', 'reward', 'approved',
        'status', 'description', 'uploader_comments', 'location_details',
    ];

    protected $casts = [
        'date_lost_found' => 'date',
        'reward' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
