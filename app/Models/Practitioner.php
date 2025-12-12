<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Practitioner extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_number',
        'fullname',
        'status_id',
        'speciality_id',
        'sub_speciality_id',
        'discipline',
        'address',
        'profile_link',
        'registration_date',
        'expiry_date',
        'is_active',
        'raw_data',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'raw_data' => 'array',
        'registration_date' => 'date',
        'expiry_date' => 'date',
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function speciality(): BelongsTo
    {
        return $this->belongsTo(Speciality::class);
    }

    public function subSpeciality(): BelongsTo
    {
        return $this->belongsTo(SubSpeciality::class);
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }

    public function qualifications(): HasMany
    {
        return $this->hasMany(Qualification::class);
    }

    public function licenses(): HasMany
    {
        return $this->hasMany(License::class);
    }

    
    // Helper methods
    public function getActiveLicenseAttribute()
    {
        return $this->licenses()->where('status', 'active')->first();
    }

    public function getPrimaryContactAttribute()
    {
        return $this->contacts()->where('is_primary', true)->first();
    }
}
