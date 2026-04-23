<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ProviderProfile;
use App\Enums\UserRole;
use App\Enums\VerificationStatus;

class RegisterController extends Controller
{
    // ==================== SHOW FORMS ====================

    public function showSeekerRegister()
    {
        if (Auth::check()) {
            return redirect()->route('seeker.dashboard');
        }
        return view('auth.seeker-register');
    }

    public function showProviderRegister()
    {
        if (Auth::check()) {
            return redirect()->route('provider.dashboard');
        }
        return view('auth.provider-register');
    }

    // ==================== REGISTRATION HANDLERS ====================

    public function seekerRegister(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|unique:users,phone|regex:/^[0-9]{10,11}$/',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'phone.regex' => 'Phone number must be 10-11 digits.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'role' => UserRole::Seeker,
            'status' => 'active',
        ]);

        Auth::login($user);
        
        return redirect()->route('seeker.dashboard')
            ->with('success', 'Welcome! Your account has been created.');
    }

    public function providerRegister(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|unique:users,phone|regex:/^[0-9]{10,11}$/',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'phone.regex' => 'Phone number must be 10-11 digits.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'role' => UserRole::Provider,
            'status' => 'pending',
        ]);

        ProviderProfile::create([
            'user_id' => $user->id,
            'verification_status' => VerificationStatus::Unverified,
        ]);

        Auth::login($user);
        
        return redirect()->route('provider.profile.complete')
            ->with('success', 'Account created! Please complete your profile.');
    }
}