<?php

namespace App\Assets\Filter;

use App\Assets\Asset;
use ILess\Parser;

class LessFilter extends BaseFilter
{
    public function dump(Asset $asset)
    {
        $parser = new Parser();
        $parser->parseString($asset->content(), $asset->sourcePath());
        $asset->setContent($parser->getCSS());
    }
}