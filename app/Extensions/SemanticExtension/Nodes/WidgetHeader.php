<?php

namespace App\Extensions\SemanticExtension\Nodes;

use App\Assets\AssetFactory;
use App\Structure\Node\HasOptimizedView;
use App\Structure\Node\Node;

class WidgetHeader extends Node implements HasOptimizedView
{
    public function optimizedView($childrenContent)
    {
        return "<header>{$childrenContent}</header>";
    }

    public function configurationAsset(AssetFactory $factory)
    {
        return $factory->file('vue', 'semantic::components/header/header.config.vue');
    }

    public function componentAsset(AssetFactory $factory)
    {
        return $factory->file('vue', 'semantic::components/header/header.vue');
    }
}
