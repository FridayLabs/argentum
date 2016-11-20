<?php

namespace Modules\Grid\Providers;

use Argentum\Assets\AssetFactory;
use Modules\Grid\Nodes\WidgetColumn;
use Modules\Grid\Nodes\WidgetContainer;
use Modules\Grid\Nodes\WidgetRow;
use Illuminate\Support\ServiceProvider;

class GridServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerNodes();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        app(AssetFactory::class)->setNamespace('grid', __DIR__ . '/../resources/assets');
    }

    protected function registerNodes()
    {
        $this->app->alias(WidgetColumn::class, 'widget-column');
        $this->app->alias(WidgetContainer::class, 'widget-container');
        $this->app->alias(WidgetRow::class, 'widget-row');
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/../Config/config.php' => config_path('grid.php'),
        ]);
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/config.php', 'grid'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/modules/grid');

        $sourcePath = __DIR__ . '/../';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/grid';
        }, \Config::get('view.paths')), [$sourcePath]), 'grid');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/modules/grid');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'grid');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../', 'grid');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
