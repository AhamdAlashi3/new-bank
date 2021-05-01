<?php

use App\Http\Controllers\API\UserApiAuthController;
use App\Http\Controllers\customercontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('auth/')->namespace('API')->group(function(){
    Route::post('login',[UserApiAuthController::class,'login']);
    Route::post('loginpgt',[UserApiAuthController::class,'loginpgt']);

});

Route::prefix('auth/')->middleware('auth:api')->group(function(){
    Route::apiResource('customer',customercontroller::class);

    Route::get('logout',[UserApiAuthController::class,'logout']);
    Route::get('logoutpgt',[UserApiAuthController::class,'logoutpgt']);
});

Route::middleware('auth:api')->group(function(){
    Route::apiResource('customers',customercontroller::class);
});