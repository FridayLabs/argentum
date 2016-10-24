<?php

namespace App\Structure\Node\Grid;

use App\Asset\LessFileAsset;
use App\Structure\Node\BaseNode;

class WidgetContainer extends BaseNode
{
    public function toHtml()
    {
        $childrenContent = parent::toHtml();
        $isFullWidth = array_get($this->getConfig(), 'isFullWidth', false);
        $class = 'contaner' . ($isFullWidth ? '-fluid' : '');
        return "<div class='{$class}'>{$childrenContent}</div>";
    }
}