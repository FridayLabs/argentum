<?php

namespace App\Structure;

use App\Assets\AssetFactory;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class Node implements Arrayable, Jsonable
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

    public function toHtml()
    {
        $childrenContent = '';
        foreach ($this->children() as $child) {
            $childrenContent .= $child->toHtml();
        }

        return $childrenContent;
    }

    public function assets(AssetFactory $factory)
    {
        return [
            $factory->file('css', vendor_path('bower-asset/normalize.css/normalize.css'), 'normalize'),
        ];
    }

    public function collectAssets(AssetFactory $factory)
    {
        $assets = $this->assets($factory);
        foreach ($this->children() as $child) {
            $assets = array_merge($assets, $child->collectAssets($factory));
        }

        return $assets;
    }
}
