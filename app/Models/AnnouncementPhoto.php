<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnnouncementPhoto extends Model
{
    protected $fillable = ['announcement_id', 'photo_path', 'order'];

    public function announcement()
    {
        return $this->belongsTo(Announcement::class);
    }
}
