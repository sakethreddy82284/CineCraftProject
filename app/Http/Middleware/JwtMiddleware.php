<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class JwtMiddleware
{
    
    public function handle(Request $request, Closure $next)
    {
        $token = $request->cookie('jwt_token');

        if (! $token) {
          
            return redirect()->route('register')->withErrors(['error' => 'Unauthorized: Please log in.']);
        }
        try {
         
            $user = JWTAuth::setToken($token)->authenticate();

            if (!$user) {
                return redirect()->route('register')->withErrors(['error' => 'User not found.']);
            } 
            Auth::login($user);
           

        } catch (TokenExpiredException $e) {
         
            return redirect()->route('register')->withErrors(['error' => 'Session expired. Please log in again.']);
        } catch (JWTException $e) {
          
            return redirect()->route('register')->withErrors(['error' => 'Authentication failed. Please log in.']);
        }
        return $next($request);
    }
}
