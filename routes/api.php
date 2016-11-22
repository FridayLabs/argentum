<?php

Route::post('auth/login', 'Api\AuthController@login');
Route::post('auth/refreshToken', 'Api\AuthController@refreshToken');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('users/me', function () {
        return Auth::user();
    });
});