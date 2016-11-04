<?php

namespace App\Providers;

use App\Assets\AssetFactory;
use App\Assets\AssetManager;
use App\Assets\AssetPattern;
use App\Assets\AssetWriter;
use App\Assets\FilesystemAssetWriter;
use App\Assets\Filter\BabelFilter;
use App\Assets\Filter\BrowserifyFilter;
use App\Assets\Filter\CssMinFilter;
use App\Assets\Filter\LessFilter;
use App\Assets\FilterManager;
use App\Structure\NodeFactory;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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
            $manager->set('browserify', $browserify);

            return $manager;
        });
        $this->app->singleton(AssetFactory::class, function () {
            $factory = new AssetFactory(resource_path('assets'));
            $factory->setFilterManager($this->app->make(FilterManager::class));
            $factory->setPattern('css', new AssetPattern('css/*.css', ['?css_min']));
            $factory->setPattern('less', new AssetPattern('css/*.css', ['less', '?css_min']));

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

        $this->app->singleton(NodeFactory::class, function () {
            return new NodeFactory();
        });
    }
}
