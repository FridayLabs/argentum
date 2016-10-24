<?php

namespace App\Structure\Node\Semantic;

use App\Structure\Node\BaseNode;

class WidgetMain extends BaseNode
{
    public function toHtml()
    {
        $childrenContent = parent::toHtml();
        return "<main>{$childrenContent}</main>";
    }
}