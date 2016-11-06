<?php

namespace App\Jobs;

use App\Assets\AssetFactory;
use App\Assets\AssetManager;
use App\Assets\AssetWriter;
use App\Composer\PageComposer;
use App\Models\Page;
use App\View\AssetsLoader;

class AssetsCompilationJob extends Job
{
    protected $page;

    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    public function handle()
    {
        $manager = app()->make(AssetManager::class);
        $structure = $this->page->getStructureWithLayout();

        $composer = new PageComposer($structure);
        $manager->addAssets($composer->assets(app(AssetFactory::class)));

        $writer = app(AssetWriter::class);
        $writer->writeManagerAssets($manager);

        dispatch(new CriticalCssCompilationJob($this->page));
    }
}
