<?php

namespace App\Services;

use App\Models\User;
use App\Models\Booking;
use App\Models\ServiceRequest;
use App\Models\VerificationDocument;
use Illuminate\Support\Facades\DB;

class AnalyticsService
{
    public function getDashboardStats(): array
    {
        return [
            'users' => [
                'total' => User::count(),
                'seekers' => User::where('role', 'seeker')->count(),
                'providers' => User::where('role', 'provider')->count(),
                'new_today' => User::whereDate('created_at', today())->count(),
            ],
            'bookings' => [
                'total' => Booking::count(),
                'today' => Booking::whereDate('created_at', today())->count(),
                'completed' => Booking::where('status', 'completed')->count(),
                'pending' => Booking::where('status', 'pending')->count(),
            ],
            'revenue' => [
                'today' => Booking::where('status', 'completed')
                    ->whereDate('completed_at', today())
                    ->sum('total_amount'),
                'total' => Booking::where('status', 'completed')->sum('total_amount'),
            ],
            'verifications' => [
                'pending' => VerificationDocument::where('status', 'pending')->count(),
                'verified_today' => VerificationDocument::where('status', 'approved')
                    ->whereDate('verified_at', today())
                    ->count(),
            ],
            'top_services' => DB::table('service_requests')
                ->join('service_categories', 'service_requests.category_id', '=', 'service_categories.id')
                ->select('service_categories.name', DB::raw('count(*) as count'))
                ->groupBy('service_categories.id', 'service_categories.name')
                ->orderBy('count', 'desc')
                ->limit(5)
                ->get(),
        ];
    }
}