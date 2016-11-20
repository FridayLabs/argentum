<?php

namespace Argentum\Providers;

use Argentum\Assets\AssetFactory;
use Argentum\Assets\AssetManager;
use Argentum\Assets\AssetPattern;
use Argentum\Assets\AssetWriter;
use Argentum\Assets\FilesystemAssetWriter;
use Argentum\Assets\Filter\BabelFilter;
use Argentum\Assets\Filter\BrowserifyFilter;
use Argentum\Assets\Filter\CssMinFilter;
use Argentum\Assets\Filter\LessFilter;
use Argentum\Assets\FilterManager;
use Argentum\Assets\NamePersistentAssetPattern;
use Illuminate\Support\ServiceProvider;

class AssetsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(FilterManager::class, function () {
            $manager = new FilterManager();
            $manager->set('less', new LessFilter());
            $manager->set('css_min', new CssMinFilter());

            $nodeExecutable = '/usr/local/bin/node'; // TODO which node
            $babel = new BabelFilter(node_path('babel-cli/bin/babel.js'), $nodeExecutable);
            $babel->addPreset('es2015');
            $manager->set('babel', $babel);

            $browserify = new BrowserifyFilter(node_path('browserify/bin/cmd.js'), $nodeExecutable);
            $browserify->addTransformer('vueify');
            $browserify->addTransformer('[ babelify --presets [ es2015 ] ]');
            $manager->set('browserify', $browserify);

            return $manager;
        });g
        $this->app->singleton(AssetFactory::class, function () {
            $factory = new AssetFactory(resource_path('assets'));
            $factory->setFilterManager($this->app->make(FilterManager::class));
            $factory->setPattern('css', new AssetPattern('css/*.css', ['?css_min']));
            $factory->setPattern('less', new AssetPattern('css/*.css', ['less', '?css_min']));
            $factory->setPattern('font', new NamePersistentAssetPattern('fonts/*'));

            $factory->setPattern('js', new AssetPattern('js/*.js'));
            $factory->setPattern('vue', new AssetPattern('js/*.js', ['browserify']));

            return $factory;
        });

        $this->app->singleton(AssetManager::class, function () {
            return new AssetManager();
        });

        $this->app->singleton(AssetWriter::class, function () {
            return new FilesystemAssetWriter(base_path('public/static'));
        });
    }
}
