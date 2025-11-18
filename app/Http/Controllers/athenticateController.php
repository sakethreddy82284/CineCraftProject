<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Cookie;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;


class AthenticateController extends Controller
{
    
   public function index(Request $request)
    { 
        return view('auth.sign');
    }
    public function register(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:6,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);

        }

        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

       
        return redirect()->back()->with('success','register completed');
    }
 public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $credentials = $request->only('email', 'password');

        if (! $token = Auth::attempt($credentials)) {
             return back()->withErrors(['email' => 'The provided credentials do not match our records.',
           ])->onlyInput('email');
        }
        $user=Auth::user();
        $cookie = Cookie::make('jwt_token',$token,60);
        
        
        if(Auth::user()->role == "admin"){
            return redirect('/admindash')->withCookie($cookie);
        }
        return redirect()->route('userdash')->withCookie($cookie);
    }



public function logout(Request $request)
{
    // 1. Get the token from the cookie
    $token = $request->cookie('jwt_token');
    
    // 2. Invalidate the JWT token (blacklist it)
    if($token){
        try{
            JWTAuth::setToken($token)->invalidate();
        }catch(\Exception $e){
            // Ignore errors (e.g., if token is already expired)
        }
    }
    
    // 3. Prepare the "delete cookie" response
    $cookie = Cookie::forget('jwt_token');

    // 4. THIS IS THE FIX: Log out of the 'web' session guard
    Auth::guard('web')->logout();
    
    // 5. Redirect to login page and send the delete cookie instruction
    return redirect()->route('register')->withCookie($cookie);
}

    
    
   
    public function userProfile()
    {
        return response()->json(auth('api')->user());
    }

    
   
}
