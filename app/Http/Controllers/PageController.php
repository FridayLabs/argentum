<?php

namespace Argentum\Http\Controllers;

use Argentum\Assets\AssetFactory;
use Argentum\Assets\AssetManager;
use Argentum\Composer\PageComposer;
use Argentum\Jobs\CompilePageAssets;
use Argentum\Model\Page;

class PageController extends Controller
{
    public function displayPage(Page $page)
    {
        $structure = $page->getStructureWithLayout();

        $composer = new PageComposer($structure);
        $manager = app(AssetManager::class);
        $manager->addAssets($composer->assets(app(AssetFactory::class)));

        $this->dispatch(new CompilePageAssets($page)); // dev only

        return view('layout', [
            'title' => $page->title,
            'content' => $composer->markup(),
            'styles' => $manager->styles(),
            'scripts' => $manager->scripts(),
        ]);
    }
}
