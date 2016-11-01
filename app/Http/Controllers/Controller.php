<?php

namespace App\Http\Controllers;

use App\Jobs\AssetsCompilationJob;
use App\Models\Page;
use App\Structure\Structure;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function displayPage(Page $page)
    {
        /**
         * @var $structure Structure
         */
        $structure = $page->getStructureWithLayout();

        dispatch(new AssetsCompilationJob($page));

        return view('layout', [
            'title'   => $page->title,
            'content' => $structure->toHtml(),
        ]);
    }
}
