<?php

namespace App\Extensions\SemanticExtension\Nodes;

use App\Structure\Node;

class WidgetFooter extends Node
{
    public function toHtml()
    {
        $childrenContent = parent::toHtml();

        return "<footer>{$childrenContent}</footer>";
    }
}
