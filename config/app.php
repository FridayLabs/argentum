<?php

return [
    'middlewares' => [
        App\Http\Middleware\Homepage::class,
        App\Http\Middleware\LoadRoutes::class,
        App\Http\Middleware\CompilesAssets::class,
    ],
    'routeMiddlewares' => [
        'auth' => App\Http\Middleware\Authenticate::class,
    ],
    'providers' => [
        App\Providers\SpacelessBladeDirectiveProvider::class,
        App\Providers\AppServiceProvider::class,
        App\Providers\RoutesServiceProvider::class,
        App\Providers\ExtensionServiceProvider::class,

        App\Providers\AuthServiceProvider::class,
        Tymon\JWTAuth\Providers\LumenServiceProvider::class
    ],
];
