<?php

namespace App\Providers;

use App\Assets\AssetPattern;
use App\Assets\Filter\LessFilter;
use App\Assets\AssetFactory;
use App\Assets\FilterManager;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('filterManager', function () {
            $manager = new FilterManager();
            $manager->set('less', new LessFilter);
            return $manager;
        });
        $this->app->bind('assetFactory', function () {
            $factory = new AssetFactory(resource_path('assets'));
            $factory->setFilterManager(app('filterManager'));
            $factory->setPattern('less', new AssetPattern('css/*.css', ['less']));
            return $factory;
        });
    }
}
