<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'species', 'breed', 'estimated_age_years', 'estimated_age_months', 'gender', 'color_markings',
        'description', 'photo', 'status', 'impounded_date', 'caught_location', 'decision_date',
        'adoption_reason', 'adoption_reason_other', 'adoption_notes',
        // 'registration_status',
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

    /**
     * Ensure pet_name is set to the display code when appropriate.
     * - After creation we can derive a stable `display_code` (PET####) because id exists.
     * - If `pet_name` is empty or still carries the old ADO/IMP prefix, replace it.
     */
    protected static function booted()
    {
        static::created(function ($pet) {
            $display = $pet->display_code ?? null;
            if ($display) {
                $currentName = $pet->name ?? '';
                if (trim($currentName) === '' || preg_match('/^(ADO|IMP)/', $currentName)) {
                    $pet->name = $display;
                    // Use saveQuietly to avoid firing observers unnecessarily (Laravel 9+)
                    if (method_exists($pet, 'saveQuietly')) {
                        $pet->saveQuietly();
                    } else {
                        $pet->save();
                    }
                }
            }
        });
    }




    // Helper: Calculate remaining days (for impounded and adoptable)
    public function getRemainingDaysAttribute()
    {
        // Determine the appropriate start date depending on current status:
        // - If currently impounded: use impounded_date or created_at
        // - If adoptable: prefer decision_date (when it became adoptable), otherwise fallback to impounded_date or created_at
        // - Otherwise: no meaningful remaining days
        $now = now()->startOfDay();

        if ($this->status === 'impounded') {
            $start = $this->impounded_date ? $this->impounded_date->startOfDay() : $this->created_at->startOfDay();
            $holdingPeriod = 3; // 3 days for impounded
        } elseif ($this->status === 'adoptable') {
            if ($this->decision_date) {
                $start = $this->decision_date->startOfDay();
            } elseif ($this->impounded_date) {
                $start = $this->impounded_date->startOfDay();
            } else {
                $start = $this->created_at->startOfDay();
            }
            $holdingPeriod = 4; // 4 days for adoptable
        } else {
            return null;
        }

        $target = $start->copy()->addDays($holdingPeriod)->startOfDay();

        // diffInDays with $absolute = false will return a signed int (positive if target in future)
        $remaining = $now->diffInDays($target, false);

        return max(0, (int) $remaining);
    }

    // Helper: Generate IMP/ADO code
    public function getDisplayCodeAttribute()
    {
        // Use simple PET + zero-padded id to replace previous ADO/IMP prefixes.
        if (!$this->id) {
            return 'PET0000';
        }

        return 'PET' . str_pad($this->id, 4, '0', STR_PAD_LEFT);
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
    // public function isUrgent()
    // {
    //     return $this->status === 'adoptable' && $this->urgent_deadline && now() < $this->urgent_deadline;
    // }

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
            if ($this->status === 'impounded') {
                $this->update(['status' => 'adoptable', 'decision_date' => now()]);
            } elseif ($this->status === 'adoptable') {
                $this->update(['status' => 'unadopted']);
            }
            return true;
        }
        return false;
    }
}
