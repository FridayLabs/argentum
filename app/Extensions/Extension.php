<?php

namespace App\Extensions;

use App\Assets\AssetFactory;
use App\Providers\RoutesServiceProvider;
use App\Structure\NodeFactory;

abstract class Extension extends RoutesServiceProvider
{
    protected $name;
    protected $basePath;

    public function name()
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

    public function basePath($path = '')
    {
        if (isset($this->basePath)) {
            return $this->basePath.($path ? '/'.$path : $path);
        }
        $class = new \ReflectionClass(get_class($this));
        $this->basePath = dirname($class->getFileName());

        return $this->basePath($path);
    }

    public function boot()
    {
        $class = new \ReflectionClass(get_class($this));

        $this->loadRoutes($class->getNamespaceName().'\Http\Controllers', $this->basePath());
        $this->loadMigrationsFrom($this->basePath('database/migrations'));
        $this->loadTranslationsFrom($this->basePath('translations'), $this->name());
        app(AssetFactory::class)->setNamespace($this->name(), $this->basePath('resources/assets'));
        $this->loadViewsFrom($this->basePath('resources/views'), $this->name());
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
}
