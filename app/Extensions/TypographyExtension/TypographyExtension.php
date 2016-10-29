<?php

namespace App\Extensions\TypographyExtension;

use App\Extensions\Extension;
use App\Extensions\TypographyExtension\Nodes\WidgetParagraph;

class TypographyExtension extends Extension
{
    protected $name = 'typography';

    protected function providesNodes()
    {
        return [
            'widget-paragraph' => WidgetParagraph::class,
        ];
    }
}
