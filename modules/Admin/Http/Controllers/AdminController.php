<?php

namespace Modules\Admin\Http\Controllers;

use Argentum\Assets\AssetFactory;
use Argentum\Assets\AssetManager;
use Argentum\Assets\AssetWriter;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function layout()
    {
        $factory = app(AssetFactory::class);
        $manager = app(AssetManager::class);
        $manager->addAssets([
            $factory->file('css', 'admin::build/css/app.css')->dependsOn(
                $factory->file('css', 'admin::build/css/vendor.css')
                    ->dependsOn('font', 'admin::fonts/glyphicons-halflings-regular.eot')
                    ->dependsOn('font', 'admin::fonts/glyphicons-halflings-regular.ttf')
                    ->dependsOn('font', 'admin::fonts/glyphicons-halflings-regular.svg')
                    ->dependsOn('font', 'admin::fonts/glyphicons-halflings-regular.woff')
                    ->dependsOn('font', 'admin::fonts/FontAwesome.otf')
                    ->dependsOn('font', 'admin::fonts/fontawesome-webfont.eot')
                    ->dependsOn('font', 'admin::fonts/fontawesome-webfont.ttf')
                    ->dependsOn('font', 'admin::fonts/fontawesome-webfont.svg')
                    ->dependsOn('font', 'admin::fonts/fontawesome-webfont.woff')
            ),
            $factory->file('js', 'admin::build/js/app.js')
        ]);
        $writer = app(AssetWriter::class);
        $writer->writeManagerAssets($manager);

        return view('admin::layout', [
            'styles' => $manager->styles(),
            'scripts' => $manager->scripts(),
        ]);
    }
}
