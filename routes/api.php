<?php

use App\Http\Controllers\API\DashboardController;
use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MobileController;
// use App\Http\Controllers\UserController;

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

//Route::post('auth/register', 'Auth\AuthController@register');
//Route::post('auth/login', 'Auth\AuthController@login');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('auth/me', 'Auth\AuthController@me');
    Route::post('auth/logout', 'Auth\AuthController@logout');
});

Route::post('getUser',[DashboardController::class,'getUser']);
Route::resource('dashboard', DashboardController::class);

Route::apiResource('posts', PostController::class)->middleware('auth:sanctum');


// Route::group(['prefix' => 'auth'], function(){
//     Route::post('register', [AuthController::class, 'createUser']);
//     Route::post('login', [AuthController::class, 'loginUser']);
//     Route::post('logout', [AuthController::class, 'logoutUser']) -> middleware('auth:sanctum');
// });

Route::group(['prefix' => 'auth'], function(){
    Route::post('register', 'Api\AuthController@register');
    Route::post('login', 'Api\AuthController@loginUser');
    Route::post('logout', 'Api\AuthController@logoutUser') -> middleware('auth:sanctum');
});