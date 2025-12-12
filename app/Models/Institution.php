<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Institution extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'country',
        'accreditation_code',
        'description',
    ];

    public function qualifications(): HasMany
    {
        return $this->hasMany(Qualification::class);
    }
}
