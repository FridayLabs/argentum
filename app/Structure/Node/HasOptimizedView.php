<?php

namespace App\Structure\Node;

interface HasOptimizedView extends HasView
{
    public function optimizedView($childrenContent);
}
