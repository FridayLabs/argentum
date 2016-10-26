<?php

namespace App\Structure\Node\Grid;

use App\Assets\AssetFactory;
use App\Structure\Node\BaseNode;

class WidgetContainer extends BaseNode
{
    public function exposeAssets(AssetFactory $factory)
    {
        return [
            $factory->file('less', 'less/grid/grid.less', 'grid')
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