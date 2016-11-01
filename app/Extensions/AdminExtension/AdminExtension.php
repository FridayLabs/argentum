<?php

namespace App\Extensions\AdminExtension;

use App\Assets\AssetFactory;
use App\Assets\AssetPattern;
use App\Assets\FilterManager;
use App\Extensions\AdminExtension\Assets\RollupFilter;
use App\Extensions\Extension;

class AdminExtension extends Extension
{
    protected $name = 'admin';

    public function boot()
    {
        parent::boot();

        $rollup = new RollupFilter(
            $this->basePath('node_modules/rollup/bin/rollup'),
            '/usr/local/bin/node'
        );
        $rollup->setFormat('cjs');
        app(FilterManager::class)->set('rollup', $rollup);
        app(AssetFactory::class)->setPattern('es6_js', new AssetPattern('js/*.js', ['rollup']));
    }
}
