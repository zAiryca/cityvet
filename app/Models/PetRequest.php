<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetRequest extends Model
{
    protected $table = 'pet_requests';

    protected $fillable = [
        'user_id', 'type', 'status', 'reason', 'contact_info',
        'requestable_id', 'requestable_type', 'admin_notes', 'photos', 'additional_data'
    ];

    // 💡 RECOMMENDATION: Add casts for automatic JSON handling
    protected $casts = [
        'photos' => 'array',
        'additional_data' => 'array',
    ];

    // 🧩 Polymorphic relationship (can belong to Pet or Event)
    public function requestable()
    {
        return $this->morphTo();
    }

    // 👤 User who made the request
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
