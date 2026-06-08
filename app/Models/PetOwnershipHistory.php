<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetOwnershipHistory extends Model
{
    use HasFactory;

    protected $table = 'pet_ownership_history';

    protected $fillable = [
        'pet_id',
        'user_id',
        'type',
        'assigned_date',
        'return_date',
        'return_reason',
        'return_reason_other',
        'return_notes',
        'adoption_reason',
        'adoption_reason_other',
        'adoption_notes',
    ];

    protected $casts = [
        'assigned_date' => 'date',
        'return_date' => 'date',
    ];

    // Relationships
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope: Get current owner (most recent without return date)
    public function scopeCurrentOwner($query)
    {
        return $query->whereNull('return_date');
    }

    // Scope: Get returned records (have return date)
    public function scopeReturned($query)
    {
        return $query->whereNotNull('return_date');
    }
}
