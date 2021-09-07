<?php

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\GroupsCollection;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\GroupsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});




