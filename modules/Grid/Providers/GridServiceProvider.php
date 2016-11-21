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
        $this->registerConfig();
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
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
