<?php

namespace App\Providers;

use App\Assets\AssetPattern;
use App\Assets\Filter\CssMinFilter;
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
            $manager->set('css_min', new CssMinFilter());
            return $manager;
        });
        $this->app->bind('assetFactory', function () {
            $factory = new AssetFactory(resource_path('assets'));
            $factory->setFilterManager(app('filterManager'));
            $factory->setPattern('css', new AssetPattern('css/*.css', ['css_min']));
            $factory->setPattern('less', new AssetPattern('css/*.css', ['less']));
            return $factory;
        });
    }
}
