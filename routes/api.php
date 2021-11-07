<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::middleware(['guest'])->group(function () {

    Route::post('/auth/register' , [ApiController::class, 'register']);
    Route::post('/auth/login' , [ApiController::class, 'login']);

});


Route::middleware(['auth:api'])->group(function () {

    Route::get('/page/create', [ApiController::class, 'page_create']);

});
