<?php

require_once __DIR__.'/../vendor/autoload.php';

try {
    (new Dotenv\Dotenv(__DIR__.'/../'))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    //
}

$app = new Laravel\Lumen\Application(realpath(__DIR__.'/../'));

$app->singleton(Illuminate\Contracts\Debug\ExceptionHandler::class, App\Exceptions\Handler::class);
$app->singleton(Illuminate\Contracts\Console\Kernel::class, App\Console\Kernel::class);

$app->withEloquent();
$app->withFacades();

$app->configure('auth');
$app->configure('app');
$app->routeMiddleware(config('app.routeMiddlewares', []));
$app->middleware(config('app.middlewares', []));
foreach (config('app.providers', []) as $provider) {
    $app->register($provider);
}

$app->configure('extensions');

return $app;
