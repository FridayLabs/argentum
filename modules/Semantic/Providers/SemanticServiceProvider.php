<?php

namespace Modules\Semantic\Providers;

use Argentum\Assets\AssetFactory;
use Illuminate\Support\ServiceProvider;
use Modules\Semantic\Nodes\WidgetFooter;
use Modules\Semantic\Nodes\WidgetHeader;
use Modules\Semantic\Nodes\WidgetMain;

class SemanticServiceProvider extends ServiceProvider
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
        app(AssetFactory::class)->setNamespace('semantic', __DIR__ . '/../resources/assets');
    }

    protected function registerNodes()
    {
        $this->app->alias(WidgetHeader::class, 'widget-header');
        $this->app->alias(WidgetMain::class, 'widget-main');
        $this->app->alias(WidgetFooter::class, 'widget-footer');
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('semantic.php'),
        ]);
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'semantic'
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
