<?php

namespace Modules\Typography\Providers;

use Argentum\Assets\AssetFactory;
use Illuminate\Support\ServiceProvider;
use Modules\Typography\Nodes\WidgetParagraph;

class TypographyServiceProvider extends ServiceProvider
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
        app(AssetFactory::class)->setNamespace('typography', __DIR__ . '/../resources/assets');
    }

    protected function registerNodes()
    {
        $this->app->alias(WidgetParagraph::class, 'widget-paragraph');
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('typography.php'),
        ]);
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'typography'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/modules/typography');

        $sourcePath = __DIR__.'/../';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/typography';
        }, \Config::get('view.paths')), [$sourcePath]), 'typography');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/modules/typography');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'typography');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../', 'typography');
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
