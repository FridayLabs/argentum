<?php

namespace Argentum\Assets\Filter;

use Argentum\Assets\Asset;
use Argentum\Assets\HashableInterface;

abstract class BaseFilter implements HashableInterface
{
    abstract public function dump(Asset $asset);

    public function hash()
    {
        return get_class($this);
    }
}
