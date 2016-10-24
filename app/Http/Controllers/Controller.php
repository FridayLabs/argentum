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

        $am = new AssetManager();
        foreach ($structure->getAssets() as $name => $asset) {
            $am->set($name, $asset);
        }
        $aw = new AssetWriter(base_path('public'));
        $aw->writeManagerAssets($am);

        return view('layout', [
            'title' => $page->title,
            'content' => $structure->toHtml()
        ]);
    }
}
