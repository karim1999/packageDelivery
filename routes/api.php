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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'auth'
], function ($router) {

    Route::post('login', 'Api\AuthController@login');
    Route::post('logout', 'Api\AuthController@logout');
    Route::post('refresh', 'Api\AuthController@refresh');
    Route::post('me', 'Api\AuthController@me');
});
Route::group([
    'prefix' => 'driver',
    'name' => 'driver',
    'middleware' => 'jwt.verify'
], function ($router) {
    Route::post('info/update', 'Api\DriverController@update');
    Route::post('location/update', 'Api\DriverController@updateLocation');
    Route::post('status/update', 'Api\DriverController@updateStatus');

});

Route::group([
    'prefix' => 'package',
    'name' => 'package',
    'middleware' => 'jwt.verify'
], function ($router) {

});

