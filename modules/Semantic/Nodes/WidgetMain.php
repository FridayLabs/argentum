<?php

namespace Modules\Semantic\Nodes;

use Argentum\Assets\AssetFactory;
use Argentum\Structure\Node\HasOptimizedView;
use Argentum\Structure\Node\Node;

class WidgetMain extends Node implements HasOptimizedView
{
    public function optimizedView($childrenContent)
    {
        return "<main>{$childrenContent}</main>";
    }

    public function configurationAsset(AssetFactory $factory)
    {
        return $factory->file('vue', 'semantic::components/main/main.config.vue');
    }

    public function componentAsset(AssetFactory $factory)
    {
        return $factory->file('vue', 'semantic::components/main/main.vue');
    }
}