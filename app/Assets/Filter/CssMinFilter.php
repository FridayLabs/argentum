<?php

namespace App\Assets\Filter;

use App\Assets\Asset;

class CssMinFilter extends BaseFilter
{
    public function dump(Asset $asset)
    {
        $asset->setContent(\Minify_CSS_Compressor::process($asset->content()));
    }
}