<?php

namespace App\Assets\Filter;

use App\Assets\Asset;

class LessFilter extends BaseFilter
{
    public function dump(Asset $asset)
    {
        $parser = new \Less_Parser();
        $parser->parseFile($asset->getSourcePath());
        $asset->setContent($parser->getCss());
    }
}