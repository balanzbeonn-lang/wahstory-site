<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureClubIdExists
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
                
            if (!empty($_SESSION['email'])) {
                if (!isset($_SESSION['club_userid'])) {
                    return redirect('https://www.wahstory.com/users/');
                }
            }
        }
        
        return $next($request);
    }
}
