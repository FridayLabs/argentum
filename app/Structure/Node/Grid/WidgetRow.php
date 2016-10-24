<?php

namespace App\Structure\Node\Grid;

use App\Structure\Node\BaseNode;

class WidgetRow extends BaseNode
{
    public function toHtml()
    {
        $childrenContent = parent::toHtml();
        return "<div class='row'>{$childrenContent}</div>";
    }

}