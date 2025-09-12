<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
  use Illuminate\Support\Facades\Session; 
    use Illuminate\Support\Facades\Route; 

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
            $submission_key = 'head_submitted_' . $familyId;
            $sessionKey = $submission_key;
            $sessionRoute = 'admin-member.show';            
            if (!session()->has($sessionKey)) {
                return redirect('/')->with('error', 'Direct access not allowed. Please submit head information first.');
            }
        }
        
        return $next($request);
    }
}