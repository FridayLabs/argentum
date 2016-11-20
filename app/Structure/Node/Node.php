<?php

namespace Argentum\Structure\Node;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class Node implements Arrayable, Jsonable
{
    const ROOT_T = '__root__';

    protected $type;
    protected $config;
    protected $parent;
    protected $children = [];

    public function __construct($type, array $config = [])
    {
        $this->type = $type;
        $this->config = $config;
    }

    public static function category()
    {
        return 'Basic';
    }

    public function type()
    {
        return $this->type;
    }

    /**
     * @return Node
     */
    public function parent()
    {
        return $this->parent;
    }

    public function setParent(Node $parent)
    {
        $this->parent = $parent;
    }

    /**
     * @return Node[]
     */
    public function children()
    {
        return $this->children;
    }

    public function addChild(Node $child)
    {
        $this->children[] = $child;
        $child->setParent($this);
    }

    /**
     * @return array
     */
    public function config()
    {
        return $this->config;
    }

    public function setConfig(Config $config)
    {
        $this->config = $config;
    }

    public function toArray()
    {
        $self = ['type' => $this->type(), 'config' => $this->config()];
        foreach ($this->children() as $child) {
            $self['children'][] = $child->toArray();
        }

        return $self;
    }

    public function toJson($options = 0)
    {
        return json_encode($this->toArray());
    }
}
