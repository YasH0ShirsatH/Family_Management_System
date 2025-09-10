<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AlreadyIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if(Session()->has('loginId') && (url('/login') ==  $request->url()))
        {
            return redirect('dashboard')->with('error','You are already logged in, logout to login with different account');
        }
        
        return $next($request);
    }
}
