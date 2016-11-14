<?php

$app->post('auth/login', 'Api\AuthController@login');
$app->post('auth/refreshToken', 'Api\AuthController@refreshToken');

$app->group(['middleware' => ['auth']], function ($app) {
    $app->get('users/me', function () {
        return app('auth')->user();
    });
    $app->resource('project', 'Api\ProjectController');
});
