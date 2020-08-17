<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

Auth::routes();

Route::middleware(['auth'])->group(function (){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/portal', 'PaymentController@portal')->name('portal');
    Route::get('/oauth', 'OauthController@index')->name('oauth');
    Route::resource('/payment_methods', 'PaymentMethodController');
    Route::get('/subscribe/{price_id}', 'SubscribeController@subscribe')->name('subscribe');
});
