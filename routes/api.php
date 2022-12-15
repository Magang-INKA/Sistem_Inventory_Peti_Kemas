<?php

use App\Http\Controllers\API\DashboardController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Api\DroppointController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MobileController;
use App\Http\Controllers\API\UserController;

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

// Route::post('login', [AuthController::class, 'login']);
// Route::post('logout', [AuthController::class, 'logout']);


// Route::post('register', [AuthController::class, 'register']);

Route::group(['prefix' => 'v1'], function(){
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    // Route::post('login', App\Http\Controllers\Api\LoginController::class);
    // Route::post('register', App\Http\Controllers\Api\RegisterController::class);
    //Route::get('logout', 'App\Http\Controllers\Api\LogoutController::class')->middleware('auth:api');
    //Route::post('logout', App\Http\Controllers\Api\LogoutController::class);
});


//Dashboard
// Route::get('/monitoring/{id}',[DashboardController::class, 'show']);

Route::get('/monitoring',[DashboardController::class,'index']);
Route::get('/monitoring/topicid={id}',[DashboardController::class, 'show']);
Route::get('/user',[UserController::class,'index']);

//Drop Point
Route::get('/droppoint',[DroppointController::class, 'index']);
Route::post('/droppoint',[DroppointController::class, 'store']);
Route::get('/droppoint/topicid={id}',[DroppointController::class, 'show']);
Route::put('/droppoint/{id}',[DroppointController::class, 'update']);
Route::delete('/droppoint/{id}',[DroppointController::class, 'destroy']);


/**
 * route "/register"
 * @method "POST"
 */
// Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');

// /**
//  * route "/login"
//  * @method "POST"
//  */
// Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');

// /**
//  * route "/user"
//  * @method "GET"
//  */
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// /**
// * route "/logout"
// * @method "POST"
// */
// Route::post('/logout', App\Http\Controllers\Api\LogoutController::class)->name('logout');

// Route::get('login', [AuthController::class, 'login']);