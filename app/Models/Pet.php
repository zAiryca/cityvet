<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'species', 'breed', 'estimated_age_years', 'estimated_age_months', 'gender', 'color_markings',
        'description', 'photo', 'status', 'impounded_date', 'caught_location', 'decision_date', 'remaining_days', 'urgent_deadline',
        'registration_status', 'admin_notes',
    ];

    // Cast dates
    protected $casts = [
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




    // Helper: Calculate remaining days (for impounded)
    public function getRemainingDaysAttribute()
    {
        if (!$this->impounded_date) return null;
        return max(0, 7 - now()->diffInDays($this->impounded_date));  // 7-day example
    }

    // Helper: Generate IMP/ADO code
    public function getDisplayCodeAttribute()
    {
        $prefix = $this->status === 'impounded' ? 'IMP' : 'ADO';
        return $prefix . str_pad($this->id, 4, '0', STR_PAD_LEFT);
    }

    // Helper: Get formatted estimated age
    public function getEstimatedAgeAttribute()
    {
        if ($this->estimated_age_years === null && $this->estimated_age_months === null) {
            return 'Unknown';
        }

        $ageString = '';

        if ($this->estimated_age_years !== null && $this->estimated_age_years > 0) {
            $ageString .= $this->estimated_age_years . ' year' . ($this->estimated_age_years > 1 ? 's' : '');
        }

        if ($this->estimated_age_months !== null && $this->estimated_age_months > 0) {
            if ($ageString) {
                $ageString .= ' ';
            }
            $ageString .= $this->estimated_age_months . ' month' . ($this->estimated_age_months > 1 ? 's' : '');
        }

        return $ageString ?: 'Unknown';
    }

    // Helper: Is urgent?
    public function isUrgent()
    {
        return $this->status === 'adoptable' && $this->urgent_deadline && now() < $this->urgent_deadline;
    }
}
