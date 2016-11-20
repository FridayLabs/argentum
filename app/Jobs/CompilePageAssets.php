<?php

namespace Argentum\Jobs;

use Argentum\Assets\AssetFactory;
use Argentum\Assets\AssetManager;
use Argentum\Assets\AssetWriter;
use Argentum\Composer\PageComposer;
use Argentum\Model\Page;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CompilePageAssets implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Page
     */
    protected $page;

    /**
     * Create a new job instance.
     *
     * @param Page $page
     */
    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $manager = app()->make(AssetManager::class);
        $structure = $this->page->getStructureWithLayout();

        $composer = new PageComposer($structure);
        $manager->addAssets($composer->assets(app(AssetFactory::class)));

        $writer = app(AssetWriter::class);
        $writer->writeManagerAssets($manager);
    }
}
