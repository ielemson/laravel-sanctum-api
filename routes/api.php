<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PasswordResetController;
use App\Http\Controllers\API\UserController;
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
Route::get('/',function(){

    return response()->json([
        'message'=> "Welcome to Hash360 API",
        'Laravel Version'=>app()->version()
    ]);
});

Route::group(['namespace' => 'API'], function() {
    // User Create Route
    Route::post('create-user',[AuthController::class,'create_user']);
    Route::post('login',[AuthController::class,'login']);

    // Password Reset Routes
    Route::post('reset-password',[PasswordResetController::class,'get_reset_token']);
    Route::get('confirm-reset-token/{token}',[PasswordResetController::class,'confirm_reset_token']);
    Route::post('update-password',[PasswordResetController::class,'update_password']);

});


Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('test',function(){

        return response()->json([
            'message'=> "Welcome Hash360 API",
            'Laravel Version'=>app()->version()
        ]);
    });

    Route::group(['namespace' => 'API'], function() {
        Route::get('user',[UserController::class,'index']);
 
    });

    Route::post('logout',[AuthController::class,'logout']);
    
    });