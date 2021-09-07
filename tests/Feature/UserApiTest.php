<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Group;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_list_all_users()
    {   
        $this->withoutExceptionHandling();
        $response = $this->get(route('users.list'));
        $response->assertSuccessful();
        $response->assertStatus(200);
    }

     /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_list_a_user()
    {   
        $this->withoutExceptionHandling();
        $user = User::first();
        $response = $this->get(route('users.show', $user->id ));
        $response->assertSuccessful();
        $response->assertStatus(200);
    }

        /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_authenticated_user_to_add_user()
    {   

        $this->withoutExceptionHandling();
        $user = User::first();
        $token = $user->createToken('Access Token')->accessToken;

        $response = $this->post("/api/users", [
            "firstname" => "Hamid",
            "lastname" => "Alpha",
            "age" => "45",
            "email" => "hamid@alpha.com",
            "phone" => "8878678600",
            "type" => "male",
            "password" => "password",
            "password_confirmation" => "password"
        ],[
            "content-type" => "application/json",
            'Authorization' => "Bearer $token",
        ]);
        $response->assertStatus(200);
    }

    public function test_authenticated_user_to_update_user()
    {   

        $this->withoutExceptionHandling();
        $user = User::first();
        $token = $user->createToken('Access Token')->accessToken;

        $response = $this->put("/api/users/$user->id", [
            "firstname" => "Hamid",
            "lastname" => "Alpha",
            "age" => "45",
            "email" => "hamid@alpha.com",
            "phone" => "8878678600",
            "type" => "male",
            "password" => "password",
            "password_confirmation" => "password"
        ],[
            "content-type" => "application/json",
            'Authorization' => "Bearer $token",
        ]);
        $response->assertStatus(200);
    }

    
    // public function test_authenticated_user_to_delete_user()
    // {   

    //     $this->withoutExceptionHandling();
    //     $user = User::first();
    //     $token = $user->createToken('Access Token')->accessToken;

    //     $response = $this->delete("/api/users/$user->id", [],[
    //         "content-type" => "application/json",
    //         'Authorization' => "Bearer $token",
    //     ]);
    //     $response->assertStatus(202);
    // }

    public function test_authenticated_user_to_attach_to_group()
    {   

        $this->withoutExceptionHandling();
        $user = User::first();
        
        $group = Group::first();
        $token = $user->createToken('Access Token')->accessToken;

        $response = $this->get("/api/attach/$user->id/$group->id", [
            "content-type" => "application/json",
            'Authorization' => "Bearer $token",
        ]);
        $response->assertStatus(200);
    }
}
