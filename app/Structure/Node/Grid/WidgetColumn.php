<?php

namespace App\Structure\Node\Grid;

use App\Assets\AssetFactory;
use App\Structure\Node\BaseNode;

class WidgetColumn extends BaseNode
{
    public function exposeAssets(AssetFactory $factory)
    {
        return [
            $factory->css('css/grid.css')->dependsOn('css/bootstrap.css')
        ];
    }

    public function toHtml()
    {
        $childrenContent = parent::toHtml();

        $classes = [];
        $config = $this->getConfig();

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