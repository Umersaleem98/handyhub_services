<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\BookingStatus;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'service_request_id', 'provider_id', 'seeker_id', 'status',
        'agreed_price', 'material_cost', 'platform_fee', 'total_amount',
        'provider_location_history', 'provider_en_route_at', 'provider_arrived_at',
        'started_at', 'completed_at', 'seeker_otp', 'completion_otp', 'otp_verified',
    ];

    protected $casts = [
        'provider_location_history' => 'array',
        'otp_verified' => 'boolean',
        'status' => BookingStatus::class,
    ];

    public function serviceRequest(): BelongsTo
    {
        return $this->belongsTo(ServiceRequest::class);
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(User::class, 'provider_id');
    }

    public function seeker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seeker_id');
    }

    public function rating()
    {
        return $this->hasOne(Rating::class);
    }
}