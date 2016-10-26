<?php

namespace App\Structure\Node\Grid;

use App\Assets\AssetFactory;
use App\Structure\Node\BaseNode;

class WidgetContainer extends BaseNode
{
    public function exposeAssets(AssetFactory $factory)
    {
        return [
            $factory->file('css/grid.css')->dependsOn('css/grid2.css')
        ];
    }

    public function toHtml()
    {
        $childrenContent = parent::toHtml();
        $isFullWidth = array_get($this->getConfig(), 'isFullWidth', false);
        $class = 'contaner' . ($isFullWidth ? '-fluid' : '');
        return "<div class='{$class}'>{$childrenContent}</div>";
    }
}