<?php

namespace App\Extensions\SemanticExtension\Nodes;

use App\Structure\Node;

class WidgetMain extends Node
{
    public function toHtml()
    {
        $childrenContent = parent::toHtml();

        return "<main>{$childrenContent}</main>";
    }
}
