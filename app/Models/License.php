<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class License extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'practitioner_id',
        'license_number',
        'issue_date',
        'expiry_date',
        'status',
        'conditions',
        'fee_amount',
        'payment_status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'issue_date' => 'date',
        'expiry_date' => 'date',
        'fee_amount' => 'decimal:2',
    ];

    /**
     * Get the practitioner that owns the license.
     */
    public function practitioner(): BelongsTo
    {
        return $this->belongsTo(Practitioner::class);
    }

    /**
     * Get the payments for the license.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Check if the license is active.
     */
    public function isActive(): bool
    {
        return $this->status === 'active' && $this->expiry_date > now();
    }

    /**
     * Check if the license is expired.
     */
    public function isExpired(): bool
    {
        return $this->status === 'expired' || $this->expiry_date < now();
    }

    /**
     * Check if the license is suspended.
     */
    public function isSuspended(): bool
    {
        return $this->status === 'suspended';
    }
}