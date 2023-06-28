<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{

    public function register(Request $request)
    {
        $validator = Validator::make($request -> all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator -> errors()], 400);
        }

        $user = User::create([
            'name' => $request -> name,
            'email' => $request -> email,
            'password' => bcrypt($request -> password)
        ]);

        $user -> roles() -> attach($request -> input('roles'));

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('token'), 201);
    }

    public function login (Request $request)
    {
        $validator = Validator::make($request ->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator -> fails()){
            return response()->json(['error' => $validator->errors()], 400);
        }

        $credentials = $request->only('email', 'password');

        if(!$token = JWTAuth::attempt($credentials)){
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

      
        //$token = $user->createToken('authToken')->plainTextToken;

        return response() -> json(compact('token'));
    }

    // public function logOut(Request $request){
    //     $request -> user() -> currentAccessToken() -> delete();

    //     return response() -> json(['message' => 'Logged out'], 200);
    // }

    public function user(Request $request){
        $user = Auth::user();
        return response() -> json(['user' => $user]);
    }
}
