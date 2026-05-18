<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;

class ProviderRequestController extends Controller
{
    public function index()
    {
        // All requests related to provider's services
        $requests = ServiceRequest::with(['service', 'user'])
            ->latest()
            ->get();

        return view('pages.provider.requests.index', compact('requests'));
    }

    /**
     * SHOW SINGLE REQUEST DETAILS
     */
    public function show($id)
    {
        $request = ServiceRequest::with(['service', 'user'])->findOrFail($id);

        return view('pages.provider.requests.show', compact('request'));
    }

    /**
     * UPDATE STATUS (ACCEPT / REJECT)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,accepted,rejected'
        ]);

        $serviceRequest = ServiceRequest::findOrFail($id);

        $serviceRequest->status = $request->status;
        $serviceRequest->save();

        return back()->with('success', 'Request status updated successfully');
    }
}
