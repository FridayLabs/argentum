<?php

namespace App\Extensions;

use App\Assets\AssetFactory;
use App\Structure\NodeFactory;
use Illuminate\Support\ServiceProvider;

abstract class Extension extends ServiceProvider
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

        $this->loadRoutes($class->getNamespaceName().'\Http\Controllers');
        $this->loadMigrationsFrom($this->basePath('migrations'));
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

    protected function loadRoutes($controllersNamespace)
    {
        $webRoutesPath = $this->basePath('routes/web.php');
        if (file_exists($webRoutesPath)) {
            $this->app->group(
                ['middleware' => 'web', 'namespace' => $controllersNamespace],
                function () use ($webRoutesPath) {
                    require $webRoutesPath;
                }
            );
        }

        $apiRoutesPath = $this->basePath('routes/web.php');
        if (file_exists($apiRoutesPath)) {
            $this->app->group(
                ['middleware' => 'api', 'namespace' => $controllersNamespace, 'prefix' => 'api/'.$this->name()],
                function () use ($apiRoutesPath) {
                    require $apiRoutesPath;
                }
            );
        }
    }
}
