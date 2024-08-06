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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


    Route::post('/login', 'App\Http\Controllers\Api\AuthController@Login');

Route::group(['prefix'=>'driver'], function () {

    Route::get('/main_profile', 'App\Http\Controllers\Api\AuthController@MainProfile');
    Route::get('/reports', 'App\Http\Controllers\Api\DriverController@Reports');

    Route::get('/home', 'App\Http\Controllers\Api\DriverController@Home');
    Route::get('/current', 'App\Http\Controllers\Api\DriverController@current');
    Route::get('/olders', 'App\Http\Controllers\Api\DriverController@olders');
    Route::get('/order', 'App\Http\Controllers\Api\DriverController@order');
    Route::get('/change_status', 'App\Http\Controllers\Api\DriverController@ChangeStatus');
    Route::post('/add_revenue', 'App\Http\Controllers\Api\DriverController@AddRevenues');
    Route::get('/revenues', 'App\Http\Controllers\Api\DriverController@Revenues');
    Route::get('/expenses', 'App\Http\Controllers\Api\DriverController@expenses');
    Route::post('/attendant', 'App\Http\Controllers\Api\DriverController@attendant');

    Route::get('/getNotifications', 'App\Http\Controllers\Api\AuthController@getNotifcations');
    Route::get('/notification', 'App\Http\Controllers\Api\AuthController@Notifcations');

});
