<?php

namespace Argentum\Structure\Node;

use Argentum\Assets\AssetFactory;

interface RequiresAssets
{
    public function assets(AssetFactory $factory);
}
