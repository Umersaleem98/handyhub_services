<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Auth::user()->bookingsAsSeeker()
            ->with(['provider.providerProfile', 'serviceRequest.category'])
            ->latest()
            ->paginate(10);

        return view('seeker.bookings.index', compact('bookings'));
    }
}