<?php

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

Route::get('unauthorized',function (){
    return response()->json([
        'message'=>"Unauthenticated."
    ],401);
})->name('unauthorized');

Route::group(['middleware' => ['token', 'auth:api']], function() {
    Route::get('stations/closest', 'StationController@showClosest');
    Route::post('stations', 'StationController@store');
    Route::put('stations/{station}', 'StationController@update');
    Route::get('stations', 'StationController@show');
    Route::delete('stations/{station}', 'StationController@delete');

});

Route::group(['prefix' => 'auth'], function () {
    Route::group(['middleware' => ['token', 'auth:api']], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('register', 'AuthController@register')->name('register');

});
