<?php


$app->get('admin/login', 'Auth\LoginController@showLoginForm');

//$app->group(['middleware' => [App\Http\Middleware\Authenticate::class]], function () use ($app) {
//
//});

