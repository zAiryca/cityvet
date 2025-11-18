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




    // Helper: Calculate remaining days (for impounded and adoptable)
    public function getRemainingDaysAttribute()
    {
        $startDate = $this->impounded_date ?: $this->decision_date ?: $this->created_at;
        return max(0, 7 - now()->diffInDays($startDate));  // 7-day holding period
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

    // Scope: For user visibility (hide unclaimed/unadopted)
    public function scopeVisibleToUsers($query)
    {
        return $query->whereNotIn('status', ['unclaimed', 'unadopted']);
    }

    // Scope: For admin unclaimed pets
    public function scopeUnclaimed($query)
    {
        return $query->where('status', 'unclaimed');
    }

    // Scope: For admin unadopted pets
    public function scopeUnadopted($query)
    {
        return $query->where('status', 'unadopted');
    }

    // Helper: Check if pet should be moved to unclaimed/unadopted
    public function shouldBeArchived()
    {
        return $this->remaining_days === 0 && in_array($this->status, ['impounded', 'adoptable']);
    }

    // Helper: Move to archived status
    public function archiveIfExpired()
    {
        if ($this->shouldBeArchived()) {
            $this->update([
                'status' => $this->status === 'impounded' ? 'unclaimed' : 'unadopted'
            ]);
            return true;
        }
        return false;
    }
}
