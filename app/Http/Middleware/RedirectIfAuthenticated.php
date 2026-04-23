<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Redirect based on role
                $user = Auth::guard($guard)->user();
                $role = is_object($user->role) ? $user->role->value : $user->role;
                
                return match($role) {
                    'admin' => redirect()->route('admin.dashboard'),
                    'seeker' => redirect()->route('seeker.dashboard'),
                    'provider' => redirect()->route('provider.dashboard'),
                    default => redirect('/'),
                };
            }
        }

        return $next($request);
    }
}