<?php

namespace App\Structure\Node;

use App\Assets\Asset;
use App\Assets\AssetFactory;

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
