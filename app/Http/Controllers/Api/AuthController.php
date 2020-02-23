<?php

namespace App\Http\Controllers\Api;

use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use Validator;
use App\User; 
use JWTAuth;
use Hash;


class AuthController extends ApiController
{
    
    public function login(Request $request){
        try {
            if (!$token = JWTAuth::attempt($request->only('email', 'password'))) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json([
            'token' => $token,
            'user' => User::where('email', $request->get('email'))->first()
        ]);
    }

    public function signUp(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:7|string',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        return response()->json([
            'token' => JWTAuth::fromUser($user),
            'user' => $user
        ]);
    }

}