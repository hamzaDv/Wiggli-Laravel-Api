<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $data = $request->all();

        $validator = Validator::make($data, [
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $credentials = request(['email', 'password']);


        if(!Auth::attempt($credentials)){
            return response()->json([
                "message" => "Invalid email or password"
            ], 401);
        }

        $user = Auth::user();
        
        $tokenResult = $user->createToken('Access Token');
        
        $user->access_token = $tokenResult->accessToken;

        return response()->json([
            "user" => $user
        ], 200);
    
    }

    public function register(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|unique:users',
            'age' => 'required',
            'type' => 'required',
            'phone' => 'required',
            'password' => 'required|confirmed'
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'age' => $request->age,
            'type' => $request->type,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            "message" => "User record created"
        ], 201);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            "message" => "User logged out successfully"
        ], 200);
    }

    public function checkLoggedIn(Request $request)
    {
        if(Auth::guard('api')->check()){
            return response()->json([
                "logged_in" => true
            ], 200);
        }else{
            return response()->json([
                "logged_in" => false
            ], 201);
        }
    }
}
