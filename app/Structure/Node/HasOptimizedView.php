<?php

namespace Argentum\Structure\Node;

interface HasOptimizedView extends HasView
{
    public function optimizedView($childrenContent);
}
