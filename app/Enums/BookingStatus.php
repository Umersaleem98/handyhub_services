<?php

namespace App\Enums;

enum BookingStatus: string
{
    case Pending = 'pending';
    case Confirmed = 'confirmed';
    case ProviderEnRoute = 'provider_en_route';
    case Arrived = 'arrived';
    case InProgress = 'in_progress';
    case Completed = 'completed';
    case CancelledByProvider = 'cancelled_by_provider';
    case CancelledBySeeker = 'cancelled_by_seeker';
    case NoShow = 'no_show';

    public function label(): string
    {
        return match($this) {
            self::Pending => 'Pending',
            self::Confirmed => 'Confirmed',
            self::ProviderEnRoute => 'En Route',
            self::Arrived => 'Arrived',
            self::InProgress => 'In Progress',
            self::Completed => 'Completed',
            self::CancelledByProvider => 'Cancelled by Provider',
            self::CancelledBySeeker => 'Cancelled by Seeker',
            self::NoShow => 'No Show',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::Pending => 'warning',
            self::Confirmed => 'info',
            self::ProviderEnRoute => 'primary',
            self::Arrived => 'primary',
            self::InProgress => 'primary',
            self::Completed => 'success',
            self::CancelledByProvider, self::CancelledBySeeker, self::NoShow => 'danger',
        };
    }
}