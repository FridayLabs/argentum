<?php

namespace App\Structure\Node\Grid;

use App\Assets\AssetFactory;
use App\Structure\Node\BaseNode;

class WidgetRow extends BaseNode
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
