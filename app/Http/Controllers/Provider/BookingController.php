<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Enums\BookingStatus;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Auth::user()->bookingsAsProvider()
            ->with(['serviceRequest.category', 'seeker'])
            ->latest()
            ->paginate(10);

        return view('provider.bookings.index', compact('bookings'));
    }

    public function accept(Booking $booking)
    {
        $this->authorize('manage', $booking);
        
        $booking->update(['status' => BookingStatus::Confirmed]);
        return back()->with('success', 'Booking accepted!');
    }

    public function updateLocation(Request $request, Booking $booking)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $history = $booking->provider_location_history ?? [];
        $history[] = [
            'lat' => $request->latitude,
            'lng' => $request->longitude,
            'time' => now()->toIso8601String(),
        ];

        $booking->update(['provider_location_history' => $history]);
        return response()->json(['success' => true]);
    }

    public function markArrived(Booking $booking)
    {
        $booking->update([
            'status' => BookingStatus::Arrived,
            'provider_arrived_at' => now(),
        ]);
        return back()->with('success', 'Marked as arrived!');
    }

    public function startService(Request $request, Booking $booking)
    {
        $request->validate(['otp' => 'required|string|size:6']);

        if ($request->otp !== $booking->seeker_otp) {
            return back()->with('error', 'Invalid OTP');
        }

        $booking->update([
            'status' => BookingStatus::InProgress,
            'started_at' => now(),
            'otp_verified' => true,
        ]);

        return back()->with('success', 'Service started!');
    }

    public function complete(Request $request, Booking $booking)
    {
        $request->validate(['otp' => 'required|string|size:6']);

        if ($request->otp !== $booking->completion_otp) {
            return back()->with('error', 'Invalid completion OTP');
        }

        $booking->update([
            'status' => BookingStatus::Completed,
            'completed_at' => now(),
        ]);

        if ($booking->provider->providerProfile) {
            $booking->provider->providerProfile->increment('total_completed_jobs');
        }

        return back()->with('success', 'Service completed!');
    }
}