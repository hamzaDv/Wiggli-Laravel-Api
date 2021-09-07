<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Group;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GroupApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_list_all_groups()
    {   
        $this->withoutExceptionHandling();
        $response = $this->get(route('groups.list'));
        $response->assertSuccessful();
        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_list_a_group()
    {   
        $this->withoutExceptionHandling();
        $group = Group::first();
        $response = $this->get(route('groups.show', $group->id ));
        $response->assertSuccessful();
        $response->assertStatus(200);
    }

        /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_authenticated_user_to_add_group()
    {   

        $this->withoutExceptionHandling();
        $user = User::first();
        $token = $user->createToken('Access Token')->accessToken;

        $response = $this->post("/api/groups", [
            "name" => "New Group",
            "description" => "Create new group for this season."
        ],[
            "content-type" => "application/json",
            'Authorization' => "Bearer $token",
        ]);
        $response->assertStatus(200);
        $this->assertTrue(count(Group::all()) > 1);
    }

    public function test_authenticated_user_to_update_group()
    {   

        $this->withoutExceptionHandling();
        $user = User::first();
        $group = Group::first();
        $token = $user->createToken('Access Token')->accessToken;

        $response = $this->put("/api/groups/$group->id", [
            "name" => "Updated Group",
            "description" => "Update new group for this season."
        ],[
            "content-type" => "application/json",
            'Authorization' => "Bearer $token",
        ]);
        $response->assertStatus(200);
    }

    
    // public function test_authenticated_user_to_delete_group()
    // {   

    //     $this->withoutExceptionHandling();
    //     $user = User::first();
    //     $group = Group::first();
    //     $token = $user->createToken('Access Token')->accessToken;

    //     $response = $this->delete("/api/groups/$group->id",[],[
    //         "content-type" => "application/json",
    //         'Authorization' => "Bearer $token",
    //     ]);
    //     $response->assertStatus(202);
    // }
    
}
