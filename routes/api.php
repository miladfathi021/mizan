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

// Phone Verification
Route::prefix('v1')->namespace('v1')->group(function () {
    Route::post('/phone-verification', 'PhoneVerificationsController@store')->name('phone-verification.store');
    Route::post('/success-phone-verification', 'PhoneVerificationsController@check')->name('success-phone-verification.check');
});

// User
Route::prefix('v1')->namespace('v1\users')->group(function () {
    Route::post('/register', 'RegisterController@store')->name('register.store');
    Route::post('/login', 'LoginController@login')->name('login.login');
});

// Lawyer
Route::prefix('v1')->namespace('v1\lawyer')->group(function () {
    Route::post('/lawyer-contracts', 'LawyerContractsController@store')->name('lawyer-contracts.store');
});

// Check token => Helpers
Route::prefix('v1')->namespace('v1\helpers')->middleware(['auth:api'])->group(function () {
    Route::post('/api-token-check', 'ApiTokensController@check')->name('api-token.check');
});
