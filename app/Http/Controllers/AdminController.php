<?php

namespace App\Http\Controllers;

use App\Assets\AssetFactory;
use App\Assets\AssetManager;
use App\Assets\AssetWriter;
use Laravel\Lumen\Routing\Controller as BaseController;

class AdminController extends BaseController
{
    public function layout()
    {
        $factory = app(AssetFactory::class);
        $manager = app(AssetManager::class);
        $manager->addAssets([
            $factory->file('css', vendor_path('bower-asset/normalize.css/normalize.css')),
            $factory->file('css', node_path('bulma/css/bulma.css')),
            $factory->file('less', 'admin/less/app.less'),
            $factory->file('vue', 'admin/js/app.js', 'app')
        ]);
        $writer = app(AssetWriter::class);
        $writer->writeManagerAssets($manager);

        return view('admin.layout', [
            'styles' => $manager->styles(),
            'scripts' => $manager->scripts(),
        ]);
    }
}
