<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserGroupsController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Api Routes

Route::get('/test', function(){
    return User::first();
});


// Route::apiResource('groups', GroupsController::class);
Route::get('/groups', [GroupsController::class, 'index'])->name('groups.list');
Route::get('/groups/{groupId}', [GroupsController::class, 'show'])->name('groups.show');

//Route::apiResource('users', UsersController::class);
Route::get('/users', [UsersController::class, 'index'])->name('users.list');
Route::get('/users/{groupId}', [UsersController::class, 'show'])->name('users.show');





Route::group([], function(){
    
    Route::prefix('auth')->group(function (){
        

        Route::get('logged', [AuthController::class, 'checkLoggedIn'])->name('logged');
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::post('register', [AuthController::class, 'register'])->name('register');
        
    });
    
    
    Route::middleware(['auth:api'])->group( function(){
        
        Route::get('/attach/{userId}/{groupId}', [UserGroupsController::class, 'attach'])->name('attach.user.group');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        
        // Route::apiResource('groups', GroupsController::class);
        Route::post('/groups', [GroupsController::class, 'store'])->name('groups.store');
        Route::put('/groups/{groupId}', [GroupsController::class, 'update'])->name('groups.update');
        Route::delete('/groups/{groupId}', [GroupsController::class, 'destroy'])->name('groups.delete');

        // // Route::apiResource('users', UsersController::class);
        Route::post('/users', [UsersController::class, 'store'])->name('users.store');
        Route::put('/users/{userId}', [UsersController::class, 'update'])->name('users.update');
        Route::delete('/users/{userId}', [UsersController::class, 'destroy'])->name('users.delete');

    });

});
