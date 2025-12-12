<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Degree extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'abbreviation',
        'level',
        'description',
    ];

    public function qualifications(): HasMany
    {
        return $this->hasMany(Qualification::class);
    }
}
