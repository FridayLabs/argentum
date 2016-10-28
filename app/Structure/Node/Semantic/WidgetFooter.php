<?php

namespace App\Structure\Node\Semantic;

use App\Structure\Node\BaseNode;

class WidgetFooter extends BaseNode
{
    public function toHtml()
    {
        $childrenContent = parent::toHtml();

        return "<footer>{$childrenContent}</footer>";
    }
}
