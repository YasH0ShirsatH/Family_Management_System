<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockDirectAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->route()->getName() === 'familySection') {
            $familyId = $request->route('id');
            $sessionKey = 'head_submitted_' . $familyId;
            
            if (!session()->has($sessionKey)) {
                return redirect('/')->with('error', 'An error occurred. The server needs specific request information before allowing access. If the issue persists, please contact the site administrator.');
            }
        }
        
        return $next($request);
    }
}