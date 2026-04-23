<?php

namespace App\Enums;

enum VerificationStatus: string
{
    case Unverified = 'unverified';
    case Pending = 'pending';
    case Verified = 'verified';
    case Rejected = 'rejected';

    public function label(): string
    {
        return match($this) {
            self::Unverified => 'Unverified',
            self::Pending => 'Pending Review',
            self::Verified => 'Verified',
            self::Rejected => 'Rejected',
        };
    }

    public function badgeClass(): string
    {
        return match($this) {
            self::Unverified => 'bg-secondary bg-opacity-10 text-secondary',
            self::Pending => 'bg-warning bg-opacity-10 text-warning',
            self::Verified => 'bg-success bg-opacity-10 text-success',
            self::Rejected => 'bg-danger bg-opacity-10 text-danger',
        };
    }
}