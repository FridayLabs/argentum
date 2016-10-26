<?php

namespace App\Assets\Asset;

use App\Assets\AssetFactory;
use Assetic\Filter\HashableInterface;

abstract class BaseAsset implements HashableInterface
{
    protected $name;
    protected $sourcePath;
    protected $filters = [];
    protected $content = false;
    protected $dependencies = [];
    protected $assetFactory;

    public function __construct($name, $sourcePath, array $filters = [])
    {
        $this->name = $name;
        $this->sourcePath = $sourcePath;
        $this->filters = $filters;
    }

    public function setAssetFactory(AssetFactory $factory)
    {
        $this->assetFactory = $factory;
        return $this;
    }

    public function getAssetFactory()
    {
        return $this->assetFactory;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getContent()
    {
        if ($this->content === false) {
            $this->content = file_get_contents($this->sourcePath);
        }
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    public function getFilters()
    {
        return $this->filters;
    }

    public function setFilters(array $filters = [])
    {
        $this->filters = $filters;
        return $this;
    }

    public function dependsOn($dependency, AssetFactory $assetFactory = null)
    {
        if (!$dependency instanceof static) {
            if ($assetFactory && !$this->assetFactory) {
                $this->setAssetFactory($assetFactory);
            } else {
                $assetFactory = $this->getAssetFactory();
            }
            $dependency = $assetFactory->file($dependency);
        }
        $this->dependencies[] = $dependency;
        return $this;
    }

    /**
     * @return BaseAsset[]
     */
    public function getDependencies()
    {
        return $this->dependencies;
    }

    public function hash()
    {
        $hashArray = [$this->sourcePath];
        foreach ($this->filters as $filter) {
            $hashArray[] = $filter->hash();
        }
        return implode('|', $hashArray);
    }
}