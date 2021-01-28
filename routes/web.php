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
    return redirect('home');
})->middleware('guest');

Auth::routes();

Route::middleware(['auth'])->group(function (){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/portal', 'PaymentController@portal')->name('portal');
    Route::get('/oauth', 'OauthController@index')->name('oauth');
    Route::resource('/payment_methods', 'PaymentMethodController');
    Route::get('/subscribe/{price_id}', 'SubscribeController@subscribe')->name('subscribe');
    Route::middleware(['subscribed'])->prefix('dashboard')->name('dashboard.')->group(function (){
        Route::get('/', 'dashboard\HomeController@index')->name('home');
        Route::resource('/package', 'dashboard\PackageController');
        Route::resource('/kanban', 'dashboard\KanbanController');
        Route::get('/change_status', 'dashboard\KanbanController@change_status');

        Route::resource('/driver', 'dashboard\DriverController');
        Route::resource('/customer', 'dashboard\CustomerController');
        Route::resource('/address', 'dashboard\AddressController');
        Route::resource('/integration', 'dashboard\IntegrationController');
        Route::resource('/setting', 'dashboard\SettingController');
    });
});
