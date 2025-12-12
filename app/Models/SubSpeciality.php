<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubSpeciality extends Model
{
    use HasFactory;

    protected $fillable = [
        'speciality_id',
        'name',
        'code',
        'description',
    ];

    public function speciality(): BelongsTo
    {
        return $this->belongsTo(Speciality::class);
    }

    public function practitioners(): HasMany
    {
        return $this->hasMany(Practitioner::class);
    }
}
