<?php

namespace App\Structure;

use App\Structure\Node\BaseNode;
use App\Structure\Node\Typography\WidgetParagraph;
use App\Structure\Node\Grid\WidgetColumn;
use App\Structure\Node\Grid\WidgetContainer;
use App\Structure\Node\Grid\WidgetRow;
use App\Structure\Node\Semantic\WidgetFooter;
use App\Structure\Node\Semantic\WidgetHeader;
use App\Structure\Node\Semantic\WidgetMain;

class NodeFactory
{
    protected $nodeClasses = [
        'widget-header' => WidgetHeader::class,
        'widget-main' => WidgetMain::class,
        'widget-footer' => WidgetFooter::class,

        'widget-container' => WidgetContainer::class,
        'widget-row' => WidgetRow::class,
        'widget-column' => WidgetColumn::class,

        'widget-paragraph' => WidgetParagraph::class
    ];

    protected function getNodeClass($type)
    {
        return array_get($this->nodeClasses, $type, BaseNode::class);
    }

    public function make(array $nodeData)
    {
        $class = $this->getNodeClass($nodeData['type']);
        return new $class($nodeData['type'], array_get($nodeData, 'config', []));
    }
}