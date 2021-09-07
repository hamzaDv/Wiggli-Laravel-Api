<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Resources\GroupResource;
use App\Http\Resources\GroupsCollection;
use Illuminate\Support\Facades\Validator;

class GroupsController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth', ['except' => ['show','index']]);
    }


    public function index()
    {
        $groups = new GroupsCollection(Group::all());
        return response( $groups, 200);

    }

    public function show($groupId)
    {
        if (Group::where('id', $groupId)->exists()) {

            $group = Group::where('id', $groupId)->get();
            return response(new GroupsCollection($group), 200);

        } else {

            return response()->json([
              "message" => "Group not found"
            ], 404);

        }
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $group = Group::create($data);

        return response()->json([
            "message" => "Group record created"
        ], 201);

    }

    public function update(Request $request, $groupId)
    {

        if (Group::where('id', $groupId)->exists()) {

            $group = Group::findOrFail($groupId);

            $group->name = is_null($request->name) ? $group->name : $request->name;
            $group->description = is_null($request->description) ? $group->description : $request->description;
            
            $group->save();
    
            return response()->json([
                "message" => "Group updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Group not found"
            ], 404);
            
        }

    }

    public function destroy($groupId)
    {
        if(Group::where('id', $groupId)->exists()) {
            Group::find($groupId)->delete();
    
            return response()->json([
              "message" => "Group deleted"
            ], 202);
        } else {
        return response()->json([
            "message" => "Group not found"
        ], 404);
        }
    }

    public function getGroupByName($name)
    {
        if (Group::where('name', $groupId)->exists()) {

            $group = Group::where('id', $groupId)->get();
            return response(new GroupsCollection($group), 200);

        } else {

            return response()->json([
              "message" => "Group not found"
            ], 404);

        }
    }

    
}
