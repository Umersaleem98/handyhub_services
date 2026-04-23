<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureUserRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        $user = Auth::user();
        
        // Check role - handle both string and enum
        $userRole = is_object($user->role) ? $user->role->value : $user->role;
        
        if ($userRole !== $role) {
            abort(403, 'Unauthorized access. Required role: ' . $role);
        }
        
        return $next($request);
    }
}