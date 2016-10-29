<?php

namespace App\Extensions\SemanticExtension;

use App\Extensions\Extension;
use App\Extensions\SemanticExtension\Nodes\WidgetFooter;
use App\Extensions\SemanticExtension\Nodes\WidgetHeader;
use App\Extensions\SemanticExtension\Nodes\WidgetMain;

class SemanticExtension extends Extension
{
    protected $name = 'semantic';

    protected function providesNodes()
    {
        return [
            'widget-header' => WidgetHeader::class,
            'widget-main'   => WidgetMain::class,
            'widget-footer' => WidgetFooter::class,
        ];
    }
}
