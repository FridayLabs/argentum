<?php

namespace App\Extensions\SemanticExtension\Nodes;

use App\Assets\AssetFactory;
use App\Structure\Node\HasOptimizedView;
use App\Structure\Node\Node;

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
