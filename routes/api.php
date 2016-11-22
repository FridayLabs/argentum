<?php


Route::post('/auth/login', 'Api\AuthController@login');

Route::group(['middleware' => ['jwt.refresh']], function () {
    Route::get('/auth/refresh', 'Api\AuthController@refresh');
});

Route::group(['middleware' => ['jwt.auth']], function () {
    Route::get('/auth/user', 'Api\AuthController@user');
});
