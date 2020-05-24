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

Route::get('stations/closest', 'StationController@showClosest');
Route::post('stations', 'StationController@store');
Route::put('stations/{station}', 'StationController@update');
Route::get('stations', 'StationController@show');
Route::delete('stations/{station}', 'StationController@delete');
