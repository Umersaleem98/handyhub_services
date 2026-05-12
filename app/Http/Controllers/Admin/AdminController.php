<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SeekerProfile;
use App\Models\ProviderProfile;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
   public function dashboard()
    {
        // USERS COUNT
        $totalUsers = User::count();
        $adminUsers = User::where('role', 'admin')->count();
        $seekerUsers = User::where('role', 'seeker')->count();
        $providerUsers = User::where('role', 'provider')->count();

        // PROFILE STATS (SEEKER)
        $seekerVerified = SeekerProfile::where('is_verified', 1)->count();
        $seekerUnverified = SeekerProfile::where('is_verified', 0)->count();

        // PROFILE STATS (PROVIDER)
        $providerVerified = ProviderProfile::where('is_verified', 1)->count();
        $providerUnverified = ProviderProfile::where('is_verified', 0)->count();

        return view('dashboard', compact(
            'totalUsers',
            'adminUsers',
            'seekerUsers',
            'providerUsers',
            'seekerVerified',
            'seekerUnverified',
            'providerVerified',
            'providerUnverified'
        ));
    }
}