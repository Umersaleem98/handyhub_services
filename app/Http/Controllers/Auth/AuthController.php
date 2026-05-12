<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function LoginScreen()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        // VALIDATION
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);

        // CREDENTIALS
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
        ];

        // REMEMBER ME
        $remember = $request->has('remember');

        // LOGIN ATTEMPT
        if (Auth::attempt($credentials, $remember)) {

            // REGENERATE SESSION
            $request->session()->regenerate();

            return redirect()->route('dashboard')
                ->with('success', 'Login Successful');
        }

        // FAILED LOGIN
        return back()->withErrors([
            'email' => 'Invalid credentials or role.',
        ])->withInput();
    }

    // REGISTER SCREEN
    public function RegisterScreen()
    {
        return view('pages.auth.register');
    }

    public function Register(Request $request)
    {
        /**
         * VALIDATION
         */
        $request->validate([

            'name' => 'required|string|max:255',

            'email' => 'required|email|unique:users,email',

            'password' => 'required|confirmed|min:6',

            'role' => 'required|in:seeker,provider',
        ]);

        /**
         * CREATE USER
         */
        $user = User::create([

            'name' => $request->name,

            'email' => $request->email,

            'role' => $request->role,

            'password' => Hash::make($request->password),
        ]);

      
        Auth::login($user);

    
        return redirect()
            ->route('login')
            ->with('success', 'Account created successfully');
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
