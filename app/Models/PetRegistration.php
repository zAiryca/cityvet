<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pet_name',
        'species',
        'breed',
        'birthday',
        'gender',
        'color_markings',
        'description',
        'photo',
        'status',
    ];

    protected $casts = [
        'birthday' => 'date',
        'color_markings' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDisplayPetIdAttribute()
    {
        return 'PR' . str_pad($this->id, 4, '0', STR_PAD_LEFT);
    }
}
