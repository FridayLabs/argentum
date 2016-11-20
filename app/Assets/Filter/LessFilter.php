<?php

namespace Argentum\Assets\Filter;

use Argentum\Assets\Asset;
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
