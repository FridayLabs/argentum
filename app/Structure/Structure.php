<?php

namespace App\Structure;

use App\Structure\Node\BaseNode;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class Structure implements Arrayable, Jsonable
{
    protected $tree;
    protected $contentSlot;

    public function __construct($structure)
    {
        if (is_string($structure)) {
            $structure = static::decode($structure);
        }
        $this->tree = $this->initTree($structure, new BaseNode(BaseNode::ROOT_T));
    }

    public function getTree()
    {
        return $this->tree;
    }

    public function getContentSlot()
    {
        return $this->contentSlot;
    }

    protected function getNodeFactory()
    {
        return app()->make(NodeFactory::class);
    }

    protected function initTree(array $tree, BaseNode $parent)
    {
        foreach ($tree as $nodeData) {
            $node = $this->getNodeFactory()->make($nodeData);
            if ($nodeData['type'] === 'system-content') {
                $this->contentSlot = $node;
            }
            $node->setParent($parent);
            $parent->addChild($node);
            if (isset($nodeData['children'])) {
                $this->initTree($nodeData['children'], $node);
            }
        }
        return $parent;
    }

    public static function encode($structure)
    {
        return json_encode($structure);
    }

    public static function decode($structure)
    {
        return json_decode($structure, true);
    }

    public function toJson($options = 0)
    {
        return static::encode($this->toArray());
    }

    public function toArray()
    {
        return $this->tree->toArray();
    }

    public function getAssets()
    {
        return $this->tree->exposeAssets();
    }

    public function toHtml()
    {
        return $this->tree->toHtml();
    }
}