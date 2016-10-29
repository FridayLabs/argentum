<?php

namespace App\Extensions\GridExtension\Nodes;

use App\Assets\AssetFactory;
use App\Structure\Node;

class WidgetContainer extends Node
{
    public function getAssets(AssetFactory $factory)
    {
        return [
            $factory->file('less', 'grid/container.less'),
        ];
    }

    public function toHtml()
    {
        $childrenContent = parent::toHtml();
        $isFullWidth = array_get($this->getConfig(), 'isFullWidth', false);
        $class = 'container'.($isFullWidth ? '-fluid' : '');

        return "<div class='{$class}'>{$childrenContent}</div>";
    }
}
