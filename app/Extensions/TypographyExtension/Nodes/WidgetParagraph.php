<?php

namespace App\Extensions\TypographyExtension\Nodes;

use App\Assets\AssetFactory;
use App\Structure\Node\HasOptimizedView;
use App\Structure\Node\Node;

class WidgetParagraph extends Node implements HasOptimizedView
{
    public function optimizedView($childrenContent)
    {
        $content = array_get($this->config(), 'content', '');

        return "<p>{$content}</p>";
    }

    public function configurationAsset(AssetFactory $factory)
    {
        return $factory->file('vue', 'typography::components/paragraph/paragraph.config.vue');
    }

    public function componentAsset(AssetFactory $factory)
    {
        return $factory->file('vue', 'typography::components/paragraph/paragraph.vue');
    }
}
