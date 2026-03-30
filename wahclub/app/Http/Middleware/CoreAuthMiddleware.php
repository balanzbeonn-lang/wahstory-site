<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CoreAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        if (isset($_SESSION['email'])) {
            
            $email = $_SESSION['email'];
            
            $user = User::where('email', $email)->first();
            if (!$user) {
                return redirect('/login'); // Redirect if user not found
            }
            
            // Optionally, log in the user in Laravel's Auth system
            Auth::loginUsingId($user->id);
        } else {
            // If not logged in, redirect to login page
            return redirect('/login');
        }
        
        return $next($request);
    }
}
