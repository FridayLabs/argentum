<?php

namespace App\Structure\Node;

use App\Assets\AssetFactory;
use App\Config;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class BaseNode implements Arrayable, Jsonable
{
    const ROOT_T = 'system-root';

    protected $type;
    protected $config;
    protected $parent;
    protected $children = [];

    public function __construct($type, array $config = [])
    {
        $this->type = $type;
        $this->config = $config;
    }

    public function isRoot()
    {
        return $this->getType() === static::ROOT_T;
    }

    public function getType()
    {
        return $this->type;
    }

    /**
     * @return BaseNode
     */
    public function getParent()
    {
        return $this->parent;
    }

    public function setParent(BaseNode $parent)
    {
        $this->parent = $parent;
    }

    /**
     * @return BaseNode[]
     */
    public function getChildren()
    {
        return $this->children;
    }

    public function addChild(BaseNode $child)
    {
        $this->children[] = $child;
        $child->setParent($this);
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    public function setConfig(Config $config)
    {
        $this->config = $config;
    }

    public function toArray()
    {
        $self = ['type' => $this->getType(), 'config' => $this->getConfig()];
        foreach ($this->getChildren() as $child) {
            $self['children'][] = $child->toArray();
        }
        return $self;
    }

    public function toJson($options = 0)
    {
        return json_encode($this->toArray());
    }

    public function toHtml()
    {
        $childrenContent = '';
        foreach ($this->getChildren() as $child) {
            $childrenContent .= $child->toHtml();
        }
        return $childrenContent;
    }

    public function exposeAssets(AssetFactory $factory)
    {
        $assets = [];
        foreach ($this->getChildren() as $child) {
            $assets = array_merge($assets, $child->exposeAssets($factory));
        }
        return $assets;
    }
}