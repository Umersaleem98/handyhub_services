<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProviderProfile;

class ProfileController extends Controller
{
    public function showCompleteForm()
    {
        return view('provider.profile.complete');
    }

    public function complete(Request $request)
    {
        $validated = $request->validate([
            'bio' => 'required|string|min:100',
            'skills' => 'required|array',
            'experience_years' => 'required|integer|min:0',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'address' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'nullable|string',
            'working_hours' => 'required|array',
        ]);

        $profile = Auth::user()->providerProfile;
        $profile->update([
            'bio' => $validated['bio'],
            'skills' => $validated['skills'],
            'experience_years' => $validated['experience_years'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'postal_code' => $validated['postal_code'],
            'working_hours' => $validated['working_hours'],
            'availability_status' => 'offline',
        ]);

        Auth::user()->update(['status' => 'active']);

        return redirect()->route('provider.documents.upload')
            ->with('success', 'Profile completed! Now upload your verification documents.');
    }

    public function showDocumentsForm()
    {
        return view('provider.profile.documents');
    }

    public function uploadDocuments(Request $request)
    {
        $request->validate([
            'cnic_front' => 'required|image|max:5120',
            'cnic_back' => 'required|image|max:5120',
            'professional_license' => 'required|file|max:5120',
            'police_clearance' => 'required|file|max:5120',
            'profile_photo' => 'required|image|max:2048',
        ]);

        $user = Auth::user();
        $service = new \App\Services\VerificationService();

        foreach ($request->allFiles() as $type => $file) {
            $service->uploadDocument($user, $type, $file);
        }

        return redirect()->route('provider.dashboard')
            ->with('success', 'Documents uploaded! Pending admin verification.');
    }
}