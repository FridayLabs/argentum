<?php

namespace App\Structure\Node\Typography;

use App\Assets\AssetFactory;
use App\Structure\Node\BaseNode;

class WidgetParagraph extends BaseNode
{
    public function getAssets(AssetFactory $factory)
    {
        return [

        ];
    }

    public function toHtml()
    {
        $childrenContent = parent::toHtml();
        $content = array_get($this->getConfig(), 'content', '');

        return "<p>{$content}{$childrenContent}</p>";
    }
}
