<?php

namespace App\Assets\Filter;

use App\Assets\Asset;
use App\Assets\HashableInterface;

abstract class BaseFilter implements HashableInterface
{
    abstract public function dump(Asset $asset);

    public function hash()
    {
        return get_class($this);
    }
}