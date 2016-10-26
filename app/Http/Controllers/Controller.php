<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Structure\Structure;
use Assetic\AssetManager;
use Assetic\AssetWriter;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;


class Controller extends BaseController
{
    public function displayPage(Request $request, Page $page)
    {
        /**
         * @var $structure Structure
         */
        $structure = $page->getStructureWithLayout();

        $assets = $structure->getAssets();
        $manager = new \App\Assets\AssetManager();
        $assets = $manager->addAssets($assets)->getAssets();

        return view('layout', [
            'title' => $page->title,
            'content' => $structure->toHtml()
        ]);
    }
}
