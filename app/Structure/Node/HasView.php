<?php

namespace Argentum\Structure\Node;

use Argentum\Assets\Asset;
use Argentum\Assets\AssetFactory;

interface HasView
{
    /**
     * @param AssetFactory $factory
     * @return Asset
     */
    public function configurationAsset(AssetFactory $factory);

    /**
     * @param AssetFactory $factory
     * @return Asset
     */
    public function componentAsset(AssetFactory $factory);
}
