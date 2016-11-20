<?php

namespace Modules\Semantic\Nodes;

use Argentum\Assets\AssetFactory;
use Argentum\Structure\Node\HasOptimizedView;
use Argentum\Structure\Node\Node;

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
