<?php

namespace App\View;

use App\Structure\Node\HasOptimizedView;
use App\Structure\Node\HasView;
use App\Structure\Node\Node;
use App\Structure\Structure;

class MarkupRenderer
{
    public function renderMarkup(Structure $structure, $optimize = false)
    {
        return $this->renderNode($structure->tree(), $optimize);
    }

    protected function renderNode(Node $node, $optimize)
    {
        $content = '';
        foreach ($node->children() as $child) {
            $content .= $this->renderNode($child, $optimize);
        }
        if ($node instanceof HasView) {
            if ($optimize && $node instanceof HasOptimizedView) {
                $content = $node->optimizedView($content);
            } else {
                $tag = $node->type();
                $config = json_encode($node->config());
                $content = "<$tag data='$config'>$content</$tag>";
            }
        }

        return $content;
    }
}