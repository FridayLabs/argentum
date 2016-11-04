<?php

namespace App\Structure;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use App\Assets\AssetFactory;
use App\Structure\Node\Node;

class Structure implements Arrayable, Jsonable
{
    protected $tree;
    protected $subtreeSlot;

    public function __construct($structure)
    {
        if (is_string($structure)) {
            $structure = static::decode($structure);
        }
        $this->tree = $this->initTree($structure, new Node(Node::ROOT_T));
    }

    public function tree()
    {
        return $this->tree;
    }

    public function subtreeSlot()
    {
        return $this->subtreeSlot;
    }

    protected function getNodeFactory()
    {
        return app()->make(NodeFactory::class);
    }

    protected function initTree(array $tree, Node $parent)
    {
        foreach ($tree as $nodeData) {
            $node = $this->getNodeFactory()->make($nodeData);
            if ($nodeData['type'] === 'system-content') {
                $this->subtreeSlot = $node;
            }
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

    public function toHtml()
    {
        return $this->tree->toHtml();
    }

    public function assets()
    {
        return $this->tree->collectAssets(app()->make(AssetFactory::class));
    }
}
