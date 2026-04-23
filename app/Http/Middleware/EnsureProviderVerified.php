<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureProviderVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        
        if (!$user->isVerifiedProvider()) {
            return redirect()->route('provider.documents.upload')
                ->with('warning', 'Please complete verification to access this feature.');
        }
        
        return $next($request);
    }
}