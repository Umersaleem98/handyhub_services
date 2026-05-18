<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;

class SeekerServiceRequestController extends Controller
{

public function index()
{

    $requests = ServiceRequest::with('service')
        ->where('user_id', auth()->id())
        ->latest()
        ->get();

    return view('pages.seeker.services.index', compact('requests'));
}


    // SHOW ALL SERVICES
    public function create()
    {
        $services = Service::latest()->get();

        return view('pages.seeker.services.create', compact('services'));
    }

    // STORE REQUEST
   public function store(Request $request)
{
    $request->validate([

        'service_id' => 'required',
        'description' => 'nullable',
        'price_range' => 'nullable',

        'location' => 'nullable',
        'latitude' => 'nullable',
        'longitude' => 'nullable',

    ]);

    ServiceRequest::create([

        'user_id' => auth()->id(),

        'service_id' => $request->service_id,

        'description' => $request->description,

        'price_range' => $request->price_range,

        'location' => $request->location,

        'latitude' => $request->latitude,

        'longitude' => $request->longitude,

    ]);

    return redirect()->back()->with(
        'success',
        'Service Request Sent Successfully'
    );
}
}
