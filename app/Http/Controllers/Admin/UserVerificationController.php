<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SeekerProfile;
use App\Models\ProviderProfile;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserVerificationController extends Controller
{
    /**
     * LIST USERS
     */
    public function index()
    {
        $users = User::with(['seekerProfile', 'providerProfile'])->latest()->get();

        return view('pages.admin.users.index', compact('users'));
    }



    /**
     * SHOW SINGLE USER
     */
    public function show($id)
    {
        $user = User::with(['seekerProfile', 'providerProfile'])->findOrFail($id);

        return view('pages.admin.users.show', compact('user'));
    }



    /**
     * VERIFY USER
     */
    public function verify($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'seeker') {

            $profile = SeekerProfile::where('user_id', $user->id)->first();

        } else {

            $profile = ProviderProfile::where('user_id', $user->id)->first();
        }

        if ($profile) {
            $profile->is_verified = true;
            $profile->verified_at = Carbon::now();
            $profile->save();
        }

        return back()->with('success', 'User verified successfully.');
    }


    public function unverify($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'seeker') {

            $profile = SeekerProfile::where('user_id', $user->id)->first();

        } else {

            $profile = ProviderProfile::where('user_id', $user->id)->first();
        }

        if ($profile) {
            $profile->is_verified = false;
            $profile->verified_at = null;
            $profile->save();
        }

        return back()->with('success', 'User unverified successfully.');
    }
}