<?php

namespace App\Jobs;

use App\Models\Page;

class CriticalCssCompilationJob extends Job
{
    protected $page;

    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    public function handle()
    {
        // TODO build critical css
    }
}
