<?php

namespace Modules\Semantic\Nodes;

use Argentum\Assets\AssetFactory;
use Argentum\Structure\Node\HasOptimizedView;
use Argentum\Structure\Node\Node;

class WidgetFooter extends Node implements HasOptimizedView
{
    public function optimizedView($childrenContent)
    {
        return "<footer>{$childrenContent}</footer>";
    }

    public function configurationAsset(AssetFactory $factory)
    {
        return $factory->file('vue', 'semantic::components/footer/footer.config.vue');
    }

    public function componentAsset(AssetFactory $factory)
    {
        return $factory->file('vue', 'semantic::components/footer/footer.vue');
    }
}
