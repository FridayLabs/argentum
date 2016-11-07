<?php

$app->get('users/me', function () {
    return \Tymon\JWTAuth\Facades\JWTAuth::parseToken()->authenticate();
});
$app->post('auth/login', 'AuthController@postLogin');