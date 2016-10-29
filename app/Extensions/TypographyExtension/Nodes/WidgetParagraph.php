<?php

namespace App\Extensions\TypographyExtension\Nodes;

use App\Assets\AssetFactory;
use App\Structure\Node;

class WidgetParagraph extends Node
{
    public function assets(AssetFactory $factory)
    {
        return [

        ];
    }

    public function toHtml()
    {
        $childrenContent = parent::toHtml();
        $content = array_get($this->config(), 'content', '');

        return "<p>{$content}{$childrenContent}</p>";
    }
}
