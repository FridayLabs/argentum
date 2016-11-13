<?php

$app->post('auth/login', 'Api\AuthController@postLogin');

$app->group(['middleware' => 'auth'], function ($app) {
    $app->get('users/me', function () {
        return \Tymon\JWTAuth\Facades\JWTAuth::parseToken()->authenticate();
    });
    $app->get('projects', 'Api\ProjectController@list');
});
