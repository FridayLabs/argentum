<?php

$app->get('users/me', function () {
    return ['user' => \Tymon\JWTAuth\Facades\JWTAuth::parseToken()->authenticate()];
});
$app->post('admin/login', 'AuthController@postLogin');