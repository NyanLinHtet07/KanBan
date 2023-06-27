<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    use HasApiTokens;

    public function register(Request $request)
    {
        $request -> validate ([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        if($validator->fails()){
            //return response()->json(['error' => ])
        }

        $user = User::create([
            'name' => $request -> name,
            'email' => $request -> email,
            'password' => Hash::make($request -> password)
        ]);

        //$toke = $user -> createToken('authToken')->plainTextToken;

        return response()->json(['token' => $token], 201);
    }

    public function login (Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request -> email) -> first();

       if(! $user || !Hash::check($request -> password, $user->password)){
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
       }

        //$token = $user->createToken('authToken')->plainTextToken;

        return response() -> json(['token' => $token], 200);
    }

    public function logOut(Request $request){
        $request -> user() -> currentAccessToken() -> delete();

        return response() -> json(['message' => 'Logged out'], 200);
    }

    public function user(Request $request){
        return response() -> json(['user' => $request->user()], 200);
    }
}
