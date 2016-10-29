<?php

namespace App\Extensions\GridExtension\Nodes;

use App\Assets\AssetFactory;
use App\Structure\Node;

class WidgetColumn extends Node
{
    public function assets(AssetFactory $factory)
    {
        return [
            $factory->file('less', 'grid::column.less')->dependsOn('less', 'grid::utils.less'),
        ];
    }

    public function toHtml()
    {
        $childrenContent = parent::toHtml();

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
}
