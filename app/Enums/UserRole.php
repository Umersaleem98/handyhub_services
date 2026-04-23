<?php

namespace App\Enums;

enum UserRole: string
{
    case Admin = 'admin';
    case Seeker = 'seeker';
    case Provider = 'provider';

    public function label(): string
    {
        return match($this) {
            self::Admin => 'Administrator',
            self::Seeker => 'Service Seeker',
            self::Provider => 'Service Provider',
        };
    }
}