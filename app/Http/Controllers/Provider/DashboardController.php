<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = $user->providerProfile;
        $verificationProgress = $user->getVerificationProgress();
        
        $stats = [
            'total_bookings' => $user->bookingsAsProvider()->count(),
            'completed_jobs' => $profile ? $profile->total_completed_jobs : 0,
            'rating' => $profile ? $profile->rating : 0,
            'earnings' => $user->bookingsAsProvider()
                ->where('status', 'completed')
                ->sum('agreed_price'),
        ];

        $recentBookings = $user->bookingsAsProvider()
            ->with(['serviceRequest.category', 'seeker'])
            ->latest()
            ->limit(5)
            ->get();

        return view('provider.dashboard.index', compact('stats', 'recentBookings', 'verificationProgress'));
    }
}