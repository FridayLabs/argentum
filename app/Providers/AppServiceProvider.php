<?php

namespace App\Providers;

use Assetic\AssetManager;
use Assetic\AssetWriter;
use Assetic\Factory\AssetFactory;
use Assetic\Filter\LessphpFilter;
use Assetic\FilterManager;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('assetManager', function () {
            $manager = new AssetManager();
            return $manager;
        });

        $this->app->bind('filterManager', function () {
            $manager = new FilterManager();
            $manager->set('less', new LessphpFilter);
            return $manager;
        });

        $this->app->bind('assetWriter', function () {
            $writer = new AssetWriter(base_path('public/static'));
            return $writer;
        });

        $this->app->bind('assetFactory', function () {
            $factory = new AssetFactory(resource_path());
            $factory->setAssetManager(app('assetManager'));
            $factory->setFilterManager(app('filterManager'));
            return $factory;
        });
    }
}
