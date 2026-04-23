<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\VerificationStatus;

class ProviderProfile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'bio', 'experience_years', 'skills', 'working_hours',
        'availability_status', 'latitude', 'longitude', 'address',
        'city', 'postal_code', 'verification_status', 'rating',
        'total_reviews', 'total_completed_jobs', 'verified_at',
    ];

    protected $casts = [
        'skills' => 'array',
        'working_hours' => 'array',
        'verification_status' => VerificationStatus::class,
        'rating' => 'decimal:1',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeAvailableInRadius($query, float $lat, float $lng, float $radiusKm = 10)
    {
        return $query
            ->where('availability_status', 'available')
            ->where('verification_status', VerificationStatus::Verified)
            ->selectRaw("*, 
                (6371 * acos(
                    cos(radians(?)) * cos(radians(latitude)) * 
                    cos(radians(longitude) - radians(?)) + 
                    sin(radians(?)) * sin(radians(latitude))
                )) AS distance", [$lat, $lng, $lat])
            ->having('distance', '<=', $radiusKm)
            ->orderBy('distance');
    }
}