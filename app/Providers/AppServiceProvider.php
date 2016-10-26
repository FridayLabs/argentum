<?php

namespace App\Providers;

use App\Assets\Asset\CssFileAsset;
use App\Assets\Filter\CssMinFilter;
use App\Assets\AssetFactory;
use App\Assets\FilterManager;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('filterManager', function () {
            $manager = new FilterManager();
            $manager->set('css_min', new CssMinFilter);
            $manager->setFiltersForType(CssFileAsset::class, ['css_min']);
            return $manager;
        });
        $this->app->bind('assetFactory', function () {
            $factory = new AssetFactory(resource_path('assets'));
            $factory->setFilterManager(app('filterManager'));
            return $factory;
        });
    }
}
