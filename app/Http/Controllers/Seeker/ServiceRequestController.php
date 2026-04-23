<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ServiceRequest;
use App\Models\ServiceCategory;
use App\Models\Quote;
use App\Models\Booking;

class ServiceRequestController extends Controller
{
    public function create()
    {
        $categories = ServiceCategory::where('is_active', true)->get();
        return view('seeker.requests.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:service_categories,id',
            'description' => 'required|string|min:20',
            'images.*' => 'nullable|image|max:5120',
            'urgency' => 'required|in:low,medium,high,emergency',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'address' => 'required|string',
            'address_details' => 'nullable|string',
            'budget_min' => 'nullable|integer|min:0',
            'budget_max' => 'nullable|integer|gte:budget_min',
            'preferred_date' => 'nullable|date|after_or_equal:today',
            'preferred_time' => 'required|in:morning,afternoon,evening,anytime',
        ]);

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $images[] = $image->store('service-requests/' . Auth::id(), 'public');
            }
        }

        $serviceRequest = ServiceRequest::create([
            'seeker_id' => Auth::id(),
            'category_id' => $validated['category_id'],
            'description' => $validated['description'],
            'images' => $images,
            'urgency' => $validated['urgency'],
            'status' => 'published',
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'address' => $validated['address'],
            'address_details' => $validated['address_details'],
            'budget_min' => $validated['budget_min'],
            'budget_max' => $validated['budget_max'],
            'preferred_date' => $validated['preferred_date'],
            'preferred_time' => $validated['preferred_time'],
        ]);

        return redirect()->route('seeker.requests.quotes', $serviceRequest)
            ->with('success', 'Request published! Waiting for quotes.');
    }

    public function index()
    {
        $requests = Auth::user()->serviceRequests()
            ->with('category')
            ->latest()
            ->paginate(10);

        return view('seeker.requests.index', compact('requests'));
    }

    public function quotes(ServiceRequest $serviceRequest)
    {
        $this->authorize('view', $serviceRequest);
        
        $quotes = $serviceRequest->quotes()
            ->with('provider.providerProfile')
            ->where('status', 'pending')
            ->get();

        return view('seeker.requests.quotes', compact('serviceRequest', 'quotes'));
    }

    public function acceptQuote(Request $request, ServiceRequest $serviceRequest)
    {
        $request->validate(['quote_id' => 'required|exists:quotes,id']);

        $quote = $serviceRequest->quotes()->findOrFail($request->quote_id);

        $serviceRequest->update(['status' => 'accepted']);

        $booking = Booking::create([
            'service_request_id' => $serviceRequest->id,
            'provider_id' => $quote->provider_id,
            'seeker_id' => Auth::id(),
            'status' => \App\Enums\BookingStatus::Pending,
            'agreed_price' => $quote->proposed_price,
            'total_amount' => $quote->proposed_price + round($quote->proposed_price * 0.10),
            'seeker_otp' => rand(100000, 999999),
            'completion_otp' => rand(100000, 999999),
        ]);

        $serviceRequest->quotes()->where('id', '!=', $quote->id)->update(['status' => 'rejected']);

        return redirect()->route('seeker.bookings')
            ->with('success', 'Quote accepted! Booking created.');
    }
}