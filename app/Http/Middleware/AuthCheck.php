<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Session()->has('loginId')) {
            return redirect('login')->with('error', 'You have to Log In first');
        }

        // Retrieve the logged-in user's ID from the session
        $userId = Session()->get('loginId');

        // Fetch the user from the database to get their status
        $user = User::find($userId);

        // Check if the user exists and their status is 0 or 9
        if ($user && in_array($user->status, [0, 9])) {
            
            if($user->status == 0){
                Session()->forget('loginId'); 
            
                return redirect('login')->with('error', 'Your account is not activated yet');
            }
            else if($user->status == 9){
                Session()->forget('loginId'); 
            
                return redirect('login')->with('error', 'Your account is blocked');
            }
        }

        return $next($request);
    }
}
