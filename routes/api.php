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

Route::prefix('v1')->namespace('v1')->group(function () {
    Route::post('/phone-verification', 'PhoneVerificationsController@store')->name('phone-verification.store');
    Route::post('/success-phone-verification', 'PhoneVerificationsController@check')->name('success-phone-verification.check');

    Route::post('/register', 'RegisterController@store')->name('register.store');
});
