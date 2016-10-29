<?php

namespace App\Extensions\SemanticExtension\Nodes;

use App\Structure\Node;

class WidgetHeader extends Node
{
    public function toHtml()
    {
        $childrenContent = parent::toHtml();

        return "<header>{$childrenContent}</header>";
    }
}
