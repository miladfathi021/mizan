<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Phone Verification
Route::prefix('v1')->namespace('v1')->group(function () {
    Route::post('/phone-verification', 'PhoneVerificationsController@store');
    Route::post('/success-phone-verification', 'PhoneVerificationsController@check');
});

// User
Route::prefix('v1')->namespace('v1\users')->group(function () {
    Route::post('/register', 'RegisterController@store');
    Route::post('/login', 'LoginController@login');
});

// Lawyer Account Request
Route::prefix('v1/lawyer')->namespace('v1\lawyer')->group(function () {
    Route::post('/register', 'LawyersController@store');
});

// Check token => Helpers
Route::prefix('v1')->namespace('v1\helpers')->middleware(['auth:api'])->group(function () {
    Route::post('/api-token-check', 'ApiTokensController@check');
});


Route::prefix('v1/admin')->namespace('v1\admin')->middleware(['auth:api', 'role:management-lawyers'])->group(function () {
    Route::post('/lawyer/register', 'LawyersController@store');
});
