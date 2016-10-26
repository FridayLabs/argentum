<?php

namespace App\Assets\Filter;

use App\Assets\Asset\BaseAsset;
use Assetic\Filter\HashableInterface;

abstract class BaseFilter implements HashableInterface
{
    abstract public function dump(BaseAsset $asset);

    public function hash()
    {
        return get_class($this);
    }
}