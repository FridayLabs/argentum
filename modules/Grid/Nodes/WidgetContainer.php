<?php

namespace Modules\Grid\Nodes;

use Argentum\Assets\AssetFactory;
use Argentum\Structure\Node\HasOptimizedView;
use Argentum\Structure\Node\Node;
use Argentum\Structure\Node\RequiresAssets;

class WidgetContainer extends Node implements HasOptimizedView, RequiresAssets
{
    public function assets(AssetFactory $factory)
    {
        return [
            $factory->file('less', 'grid::less/container.less'),
        ];
    }

    public function optimizedView($childrenContent)
    {
        $isFullWidth = array_get($this->config(), 'isFullWidth', false);
        $class = 'container' . ($isFullWidth ? '-fluid' : '');

        return "<div class='{$class}'>{$childrenContent}</div>";
    }

    public function configurationAsset(AssetFactory $factory)
    {
        return $factory->file('vue', 'grid::components/container/container.config.vue');
    }

    public function componentAsset(AssetFactory $factory)
    {
        return $factory->file('vue', 'grid::components/container/container.vue');
    }
}
