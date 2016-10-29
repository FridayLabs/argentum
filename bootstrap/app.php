<?php

require_once __DIR__.'/../app/helpers.php';
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

$app->configure('app');
$app->middleware(config('app.middlewares', []));
$app->routeMiddleware(config('app.routeMiddlewares', []));
foreach (config('app.providers', []) as $provider) {
    $app->register($provider);
}

$app->configure('extensions');

return $app;
