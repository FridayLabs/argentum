<?php

namespace App\Extensions\GridExtension\Nodes;

use App\Assets\AssetFactory;
use App\Structure\Node\HasOptimizedView;
use App\Structure\Node\Node;
use App\Structure\Node\RequiresAssets;

class WidgetColumn extends Node implements HasOptimizedView, RequiresAssets
{
    public function assets(AssetFactory $factory)
    {
        return [
            $factory->file('less', 'grid::less/column.less')->dependsOn('less', 'grid::less/utils.less'),
        ];
    }

    public function optimizedView($childrenContent)
    {
        $classes = [];
        $config = $this->config();

        foreach (array_get($config, 'size') ?: [] as $mod => $value) {
            $classes[] = implode('-', ['col', $mod, $value]);
        }
        foreach (array_get($config, 'offset') ?: [] as $mod => $value) {
            $classes[] = implode('-', ['col', $mod, 'offset', $value]);
        }
        foreach (array_get($config, 'visibility') ?: [] as $mod => $value) {
            $classes[] = implode('-', [$value ? 'visible' : 'hidden', $mod]);
        }

        $classes = implode(' ', $classes);

        return "<div class='{$classes}'>{$childrenContent}</div>";
    }

    public function configurationAsset(AssetFactory $factory)
    {
        return $factory->file('vue', 'grid::components/column/column.config.vue');
    }

    public function componentAsset(AssetFactory $factory)
    {
        return $factory->file('vue', 'grid::components/column/column.vue');
    }
}
