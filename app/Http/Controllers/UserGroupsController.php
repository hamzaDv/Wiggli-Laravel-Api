<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\UserGroup;
use Illuminate\Http\Request;

class UserGroupsController extends Controller
{
    public function attach(Request $request)
    {
        $userId =  $request->userId;
        $groupId =  $request->groupId;

        if (User::where('id', $userId)->exists() && Group::where('id', $groupId)->exists()) {

            $group = Group::find($groupId);
            
            $user = User::find($userId);
            
            $user->groups()->attach($group->id);
    
            return response()->json([
                "message" => "User attached successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "User & Group not found"
            ], 404);
            
        }
    }
}
