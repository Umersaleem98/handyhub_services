<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $stats = [
            'total_requests' => $user->serviceRequests()->count(),
            'active_bookings' => $user->bookingsAsSeeker()
                ->whereIn('status', ['pending', 'confirmed', 'in_progress'])
                ->count(),
            'completed_jobs' => $user->bookingsAsSeeker()
                ->where('status', 'completed')
                ->count(),
        ];

        $recentRequests = $user->serviceRequests()
            ->with('category')
            ->latest()
            ->limit(5)
            ->get();

        $activeBookings = $user->bookingsAsSeeker()
            ->with(['provider.providerProfile', 'serviceRequest.category'])
            ->whereIn('status', ['confirmed', 'provider_en_route', 'arrived', 'in_progress'])
            ->get();

        return view('seeker.dashboard.index', compact('stats', 'recentRequests', 'activeBookings'));
    }
}