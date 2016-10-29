<?php

namespace App\Extensions;

use App\Structure\NodeFactory;
use Illuminate\Support\ServiceProvider;

abstract class Extension extends ServiceProvider
{
    protected $name;

    public function getName()
    {
        return $this->name ?: get_class($this);
    }

    protected function providesNodes()
    {
        return [];
    }

    protected function providesCommands()
    {
        return [];
    }

    public function boot()
    {
        $class = new \ReflectionClass(get_class($this));
        $basePath = dirname($class->getFileName());

        $this->loadRoutes($class->getNamespaceName() . '\Http\Controllers', $basePath);
        $this->loadMigrationsFrom($basePath.'/migrations');
        $this->loadTranslationsFrom($basePath.'/translations', $this->getName());
        $this->loadViewsFrom($basePath.'/resources/views', $this->getName());
        $this->loadCommands($this->providesCommands());
        $this->loadNodes($this->providesNodes());
    }

    protected function loadCommands($commands)
    {
        if ($this->app->runningInConsole()) {
            $this->commands($commands);
        }
    }

    protected function loadNodes($nodes)
    {
        $this->app->afterResolving(NodeFactory::class, function (NodeFactory $factory) use ($nodes) {
            foreach ($nodes as $type => $nodeClass) {
                $factory->registerNodeClass($type, $nodeClass);
            }
        });
    }

    protected function loadRoutes($controllersNamespace, $basePath)
    {
        $webRoutesPath = $basePath . '/routes/web.php';
        if (file_exists($webRoutesPath)) {
            $this->app->group(
                ['middleware' => 'web', 'namespace' => $controllersNamespace, 'prefix' => $this->getName()],
                function () use ($webRoutesPath) {
                    require $webRoutesPath;
                }
            );
        }

        $apiRoutesPath = $basePath . '/routes/api.php';
        if (file_exists($apiRoutesPath)) {
            $this->app->group(
                ['middleware' => 'api', 'namespace' => $controllersNamespace, 'prefix' => 'api/' . $this->getName()],
                function () use ($apiRoutesPath) {
                    require $apiRoutesPath;
                }
            );
        }
    }
}
