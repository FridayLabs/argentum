<?php

namespace App\Extensions\GridExtension\Nodes;

use App\Assets\AssetFactory;
use App\Structure\Node;

class WidgetRow extends Node
{
    public function getAssets(AssetFactory $factory)
    {
        return [
            $factory->file('less', 'grid/row.less')->dependsOn('grid/utils.less'),
        ];
    }

    public function toHtml()
    {
        $childrenContent = parent::toHtml();

        return "<div class='row'>{$childrenContent}</div>";
    }
}
