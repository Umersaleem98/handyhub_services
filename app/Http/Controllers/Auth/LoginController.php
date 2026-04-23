<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserRole;

class LoginController extends Controller
{
    // ==================== SHOW LOGIN FORMS ====================
    
    public function showSeekerLogin()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole();
        }
        return view('auth.seeker-login');
    }

    public function showProviderLogin()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole();
        }
        return view('auth.provider-login');
    }

    public function showAdminLogin()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole();
        }
        return view('auth.admin-login');
    }

    // ==================== LOGIN HANDLERS ====================

    public function seekerLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            
            if ($user->role->value !== 'seeker') {
                Auth::logout();
                $request->session()->invalidate();
                return back()->with('error', 'This account is not a seeker account. Please use the correct login page.');
            }

            if ($user->status === 'suspended') {
                Auth::logout();
                $request->session()->invalidate();
                return back()->with('error', 'Your account has been suspended.');
            }

            return redirect()->route('seeker.dashboard');
        }

        return back()->with('error', 'Invalid email or password.')->withInput();
    }

    public function providerLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            
            if ($user->role->value !== 'provider') {
                Auth::logout();
                $request->session()->invalidate();
                return back()->with('error', 'This account is not a provider account. Please use the correct login page.');
            }

            if ($user->status === 'suspended') {
                Auth::logout();
                $request->session()->invalidate();
                return back()->with('error', 'Your account has been suspended.');
            }

            return redirect()->route('provider.dashboard');
        }

        return back()->with('error', 'Invalid email or password.')->withInput();
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            
            if ($user->role->value !== 'admin') {
                Auth::logout();
                $request->session()->invalidate();
                return back()->with('error', 'This account is not an admin account. Access denied.');
            }

            // Store admin session flag
            session(['is_admin' => true]);
            
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Invalid admin credentials.')->withInput();
    }

    // ==================== LOGOUT ====================

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }

    // ==================== HELPER ====================

    private function redirectBasedOnRole()
    {
        $user = Auth::user();
        $role = is_object($user->role) ? $user->role->value : $user->role;
        
        return match($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'seeker' => redirect()->route('seeker.dashboard'),
            'provider' => redirect()->route('provider.dashboard'),
            default => redirect('/'),
        };
    }
}