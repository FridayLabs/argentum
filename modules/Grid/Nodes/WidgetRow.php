<?php

namespace Modules\Grid\Nodes;

use Argentum\Assets\AssetFactory;
use Argentum\Structure\Node\HasOptimizedView;
use Argentum\Structure\Node\Node;
use Argentum\Structure\Node\RequiresAssets;

class WidgetRow extends Node implements HasOptimizedView, RequiresAssets
{
    public function assets(AssetFactory $factory)
    {
        return [
            $factory->file('less', 'grid::less/row.less')->dependsOn('grid::less/utils.less'),
        ];
    }

    public function optimizedView($childrenContent)
    {
        return "<div class='row'>{$childrenContent}</div>";
    }

    public function configurationAsset(AssetFactory $factory)
    {
        return $factory->file('vue', 'grid::components/row/row.config.vue');
    }

    public function componentAsset(AssetFactory $factory)
    {
        return $factory->file('vue', 'grid::components/row/row.vue');
    }
}
