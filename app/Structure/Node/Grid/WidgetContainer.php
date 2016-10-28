<?php

namespace App\Structure\Node\Grid;

use App\Assets\AssetFactory;
use App\Structure\Node\BaseNode;

class WidgetContainer extends BaseNode
{
    public function getAssets(AssetFactory $factory)
    {
        return [
            $factory->file('less', 'grid/container.less')
        ];
    }

    public function toHtml()
    {
        $childrenContent = parent::toHtml();
        $isFullWidth = array_get($this->getConfig(), 'isFullWidth', false);
        $class = 'container' . ($isFullWidth ? '-fluid' : '');
        return "<div class='{$class}'>{$childrenContent}</div>";
    }
}