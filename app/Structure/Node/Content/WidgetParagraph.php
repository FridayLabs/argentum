<?php

namespace App\Structure\Node\Content;

use App\Structure\Node\BaseNode;

class WidgetParagraph extends BaseNode
{
    public function toHtml()
    {
        $childrenContent = parent::toHtml();
        $content = array_get($this->getConfig(), 'content', '');
        return "<p>{$content}{$childrenContent}</p>";
    }
}