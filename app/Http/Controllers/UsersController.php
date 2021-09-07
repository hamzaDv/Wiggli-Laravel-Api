<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UsersCollection;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show','index']]);

    }
    
    public function index()
    {
        $users = new UsersCollection(User::all());
        return response( $users, 200);

    }

    public function show($userId)
    {
        if (User::where('id', $userId)->exists()) {

            $user = User::where('id', $userId)->get();
            return response(new UsersCollection($user), 200);

        } else {

            return response()->json([
              "message" => "User not found"
            ], 404);

        }
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|unique:users',
            'age' => 'required',
            'type' => 'required',
            'phone' => 'required',
            'password' => 'required'
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

    public function update(Request $request, $userId)
    {

        if (User::where('id', $userId)->exists()) {

            $user = User::findOrFail($userId);

            $user->firstname = is_null($request->firstname) ? $user->firstname : $request->firstname;
            $user->lastname = is_null($request->lastname) ? $user->lastname : $request->lastname;
            $user->email = is_null($request->email) ? $user->email : $request->email;
            $user->age = is_null($request->age) ? $user->age : $request->age;
            $user->type = is_null($request->type) ? $user->type : $request->type;
            $user->phone = is_null($request->phone) ? $user->phone : $request->phone;
            
            $user->save();
    
            return response()->json([
                "message" => "User updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "User not found"
            ], 404);
            
        }

    }

    public function destroy($userId)
    {
        if(User::where('id', $userId)->exists()) {
            $user = User::find($userId);
            $user->delete();
    
            return response()->json([
              "message" => "User deleted"
            ], 202);
          } else {
            return response()->json([
              "message" => "User not found"
            ], 404);
          }
    }

    
}
