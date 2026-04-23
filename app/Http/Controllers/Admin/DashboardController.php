<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AnalyticsService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct(private AnalyticsService $analytics) {}

    public function index()
    {
        // Double-check admin role
        $user = Auth::user();
        if (!$user || $user->role->value !== 'admin') {
            Auth::logout();
            return redirect()->route('admin.login')->with('error', 'Unauthorized access.');
        }

        $stats = $this->analytics->getDashboardStats();
        return view('admin.dashboard.index', compact('stats'));
    }
}