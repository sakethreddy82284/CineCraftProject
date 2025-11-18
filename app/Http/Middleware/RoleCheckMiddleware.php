<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleCheckMiddleware
{
        public function handle(Request $request, Closure $next): Response
    {
        
        if (!Auth::check()) {
            return redirect()->route('register');
        }

        $user = Auth::user();
        if ($user->role == "admin") {
            return $next($request);
        }
  
        return redirect()->route('register')->with('error', 'Unauthorized: You do not have permission to access this page.');
        
    
    }
}