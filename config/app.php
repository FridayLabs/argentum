<?php
return [
    'middlewares' => [
        App\Http\Middleware\Homepage::class,
        App\Http\Middleware\LoadRoutes::class
    ],
    'routeMiddlewares' => [
        'auth' => App\Http\Middleware\Authenticate::class,
    ],
    'providers' => [
        App\Providers\SpacelessBladeDirectiveProvider::class,
        App\Providers\AppServiceProvider::class,
    ]
];