<?php

namespace App\Structure\Node;

use App\Assets\AssetFactory;

interface RequiresAssets
{
    public function assets(AssetFactory $factory);
}