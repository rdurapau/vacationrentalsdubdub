<?php

namespace App\Http\Controllers\Api;

use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use App\User; 
use JWTAuth;
use Hash;


class AuthController extends ApiController
{
    
    public function login(Request $request){
        try {
            if (! $token = JWTAuth::attempt($request->only('email', 'password'))) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

    public function signUp(Request $request){
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json([
            'token' => JWTAuth::fromUser($user),
            'user' => $user
        ]);
    }

}