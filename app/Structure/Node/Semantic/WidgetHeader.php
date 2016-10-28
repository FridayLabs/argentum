<?php

namespace App\Structure\Node\Semantic;

use App\Structure\Node\BaseNode;

class WidgetHeader extends BaseNode
{
    public function toHtml()
    {
        $childrenContent = parent::toHtml();

        return "<header>{$childrenContent}</header>";
    }
}
