<?php

namespace App\Extensions\AdminExtension;

use App\Assets\AssetFactory;
use App\Assets\AssetPattern;
use App\Assets\Filter\BabelFilter;
use App\Assets\Filter\BrowserifyFilter;
use App\Assets\FilterManager;
use App\Extensions\Extension;

class AdminExtension extends Extension
{
    protected $name = 'admin';

    public function boot()
    {
        parent::boot();

        $nodeExecutable = '/usr/local/bin/node';

        $babel = new BabelFilter(node_path('babel-cli/bin/babel.js'), $nodeExecutable);
        $babel->addPreset('es2015');
        app(FilterManager::class)->set('babel', $babel);

        $browserify = new BrowserifyFilter(node_path('browserify/bin/cmd.js'), $nodeExecutable);
        $browserify->addTransformer('vueify');
        app(FilterManager::class)->set('browserify', $browserify);

        app(AssetFactory::class)->setPattern('vue', new AssetPattern('js/*.js', ['babel', 'browserify']));
    }
}
