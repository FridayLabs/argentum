<?php

namespace App\Http\Controllers;

use App\Assets\AssetFactory;
use App\Assets\AssetManager;
use App\Composer\PageComposer;
use App\Jobs\AssetsCompilationJob;
use App\Models\Page;
use App\View\MarkupRenderer;
use App\Structure\Structure;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function displayPage(Page $page)
    {
        /**
         * @var Structure
         */
        $structure = $page->getStructureWithLayout();

        $composer = new PageComposer($structure);
        $manager = new AssetManager();
        $manager->addAssets($composer->assets(app(AssetFactory::class)));

        dispatch(new AssetsCompilationJob($page));

        return view('layout', [
            'title' => $page->title,
            'content' => $composer->markup(),
            'styles' => $manager->styles(),
            'scripts' => $manager->scripts(),
        ]);
    }
}
