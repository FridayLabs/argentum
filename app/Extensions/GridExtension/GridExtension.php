<?php

namespace App\Extensions\GridExtension;

use App\Extensions\Extension;
use App\Extensions\GridExtension\Nodes\WidgetColumn;
use App\Extensions\GridExtension\Nodes\WidgetContainer;
use App\Extensions\GridExtension\Nodes\WidgetRow;

class GridExtension extends Extension
{
    protected $name = 'grid';

    protected function providesNodes()
    {
        return [
            'widget-column'    => WidgetColumn::class,
            'widget-container' => WidgetContainer::class,
            'widget-row'       => WidgetRow::class,
        ];
    }
}
