<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Enums\UserRole;
use App\Enums\VerificationStatus;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name', 'email', 'phone', 'password', 'role', 'status',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'password' => 'hashed',
        'role' => UserRole::class,
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeProviders($query)
    {
        return $query->where('role', UserRole::Provider);
    }

    public function scopeSeekers($query)
    {
        return $query->where('role', UserRole::Seeker);
    }

    public function providerProfile(): HasOne
    {
        return $this->hasOne(ProviderProfile::class);
    }

    public function verificationDocuments(): HasMany
    {
        return $this->hasMany(VerificationDocument::class);
    }

    public function serviceRequests(): HasMany
    {
        return $this->hasMany(ServiceRequest::class, 'seeker_id');
    }

    public function bookingsAsProvider(): HasMany
    {
        return $this->hasMany(Booking::class, 'provider_id');
    }

    public function bookingsAsSeeker(): HasMany
    {
        return $this->hasMany(Booking::class, 'seeker_id');
    }

    public function isVerifiedProvider(): bool
    {
        return $this->role === UserRole::Provider 
            && $this->providerProfile 
            && $this->providerProfile->verification_status === VerificationStatus::Verified;
    }

    public function hasCompletedProfile(): bool
    {
        if ($this->role !== UserRole::Provider) return true;
        $profile = $this->providerProfile;
        if (!$profile) return false;
        return $profile->bio && $profile->skills && $profile->latitude && $profile->longitude;
    }

    public function getVerificationProgress(): array
    {
        $requiredDocs = ['cnic_front', 'cnic_back', 'professional_license', 'police_clearance', 'profile_photo'];
        $uploaded = $this->verificationDocuments()
            ->whereIn('document_type', $requiredDocs)
            ->where('status', 'approved')
            ->pluck('document_type')
            ->toArray();
            
        return [
            'total_required' => count($requiredDocs),
            'uploaded' => count($uploaded),
            'missing' => array_diff($requiredDocs, $uploaded),
            'percentage' => count($requiredDocs) > 0 ? round((count($uploaded) / count($requiredDocs)) * 100) : 0,
            'is_fully_verified' => count($uploaded) === count($requiredDocs),
        ];
    }
}