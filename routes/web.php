<?php

use App\Models\UserRelation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Post;
use App\Models\Page;

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

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/logout', function () {
//    Auth::logout();
//    die('logged out');
//})->middleware('auth');

Route::get('/test', function () {
    $user2 = User::findOrFail(2);

    $followUsers = $user2->followUsers()->get();

    dd($followUsers);

});


