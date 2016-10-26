<?php

namespace App\Structure\Node\Grid;

use App\Assets\AssetFactory;
use App\Structure\Node\BaseNode;

class WidgetRow extends BaseNode
{
    public function exposeAssets(AssetFactory $factory)
    {
        return [
            $factory->file('less', 'less/grid/grid.less', 'grid')
        ];
    }

    public function toHtml()
    {
        $childrenContent = parent::toHtml();
        return "<div class='row'>{$childrenContent}</div>";
    }
}