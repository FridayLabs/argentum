<?php

namespace App\Jobs;

use App\Assets\AssetManager;
use App\Assets\FilesystemAssetWriter;
use App\Models\Page;

class AssetsCompilationJob extends Job
{
    protected $page;

    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    public function handle()
    {
        $manager = new AssetManager();
        $manager->addAssets($this->page->structure->getAssets());
        $writer = new FilesystemAssetWriter(base_path('public/static'));
        $writer->writeManagerAssets($manager);
    }
}
