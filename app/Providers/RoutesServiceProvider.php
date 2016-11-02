<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RoutesServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutes('App\Http\Controllers', app()->basePath());
    }

    protected function loadRoutes($controllersNamespace, $basePath)
    {
        $webRoutesPath = $basePath . '/routes/web.php';
        if (file_exists($webRoutesPath)) {
            $this->app->group(
                ['namespace' => $controllersNamespace],
                $this->routeLoader($webRoutesPath)
            );
        }

        $apiRoutesPath = $basePath . 'routes/api.php';
        if (file_exists($apiRoutesPath)) {
            $this->app->group(
                ['namespace' => $controllersNamespace, 'prefix' => 'api/'],
                $this->routeLoader($apiRoutesPath)
            );
        }
    }

    protected function routeLoader($path)
    {
        return function () use ($path) {
            $app = $this->app;
            require $path;
        };
    }
}