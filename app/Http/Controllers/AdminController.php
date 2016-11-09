<?php

namespace App\Http\Controllers;

use App\Assets\Asset;
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
            $factory->file('css', 'admin/css/bootstrap.min.css', 'bootstrap')
                ->dependsOn('font', 'admin/fonts/glyphicons-halflings-regular.eot')
                ->dependsOn('font', 'admin/fonts/glyphicons-halflings-regular.ttf')
                ->dependsOn('font', 'admin/fonts/glyphicons-halflings-regular.svg')
                ->dependsOn('font', 'admin/fonts/glyphicons-halflings-regular.woff'),
            $factory->file('css', 'admin/css/font-awesome.css', 'font-awesome')
                ->dependsOn('font', 'admin/fonts/FontAwesome.otf')
                ->dependsOn('font', 'admin/fonts/fontawesome-webfont.eot')
                ->dependsOn('font', 'admin/fonts/fontawesome-webfont.ttf')
                ->dependsOn('font', 'admin/fonts/fontawesome-webfont.svg')
                ->dependsOn('font', 'admin/fonts/fontawesome-webfont.woff'),
            $factory->file('css', 'admin/css/gsdk.css', 'vendor_css')->dependsOn(['bootstrap', 'font-awesome']),
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
