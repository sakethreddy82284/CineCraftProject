<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
class RedirectIfJwtAuthenticatedMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
     $token = $request->cookie('jwt_token');
        if(!$token){
            return $next($request);
        }
     try {       
            if (JWTAuth::setToken($token)->check()) { 
                return redirect('/userdashboard');
            }
        } catch (\Exception $e) { 
            return $next($request);
        }
        return $next($request);
    }
}
