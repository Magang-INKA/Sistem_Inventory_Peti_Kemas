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


Route::group(['prefix' => 'v1'], function(){
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
});


Route::group(['prefix' => 'user'], function(){
    Route::get('/',[UserController::class,'index']);
    Route::get('/{id}',[UserController::class,'show']);
    Route::put('/email/{id}', [UserController::class, 'email']);
    Route::put('/telp/{id}', [UserController::class, 'telp']);
    Route::put('/password/{id}', [UserController::class, 'password']);
});

Route::get('/monitoring',[DashboardController::class,'index']);
Route::get('/monitoring/hitung',[DashboardController::class,'hitung']);
Route::get('/container/hitung',[DashboardController::class,'hitungc']);
Route::get('/monitoring/topicid={id}',[DashboardController::class, 'show']);


//Drop Point
Route::get('/pelabuhan',[DroppointController::class, 'pelabuhan']);
Route::get('/kapal',[DroppointController::class, 'kapal']);
Route::get('/kapal/{id}/container',[DroppointController::class, 'kapalcontainer']);
Route::get('/droppoint',[DroppointController::class, 'index']);
Route::get('/alldroppoint',[DroppointController::class, 'allList']);
Route::post('/droppoint',[DroppointController::class, 'store']);
Route::get('/droppoint/topicid={id}',[DroppointController::class, 'show']);
Route::get('/droppoint/edit/{id}',[DroppointController::class, 'edit']);
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