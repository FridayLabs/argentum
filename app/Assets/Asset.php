<?php

namespace App\Assets;

use App\Assets\Filter\BaseFilter;

class Asset implements HashableInterface
{
    protected $name;
    protected $sourcePath;
    protected $targetPath;
    protected $filters = [];

    protected $content = false;
    protected $dependencies = [];
    protected $assetFactory;

    public function __construct($name, $sourcePath, $targetPath, array $filters = [])
    {
        $this->name = $name;
        $this->sourcePath = $sourcePath;
        $this->targetPath = $targetPath;
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

    public function getSourcePath()
    {
        return $this->sourcePath;
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

    /**
     * @return BaseFilter[]
     */
    public function getFilters()
    {
        return $this->filters;
    }

    public function setFilters(array $filters = [])
    {
        $this->filters = $filters;
        return $this;
    }

    public function dependsOn($pattern, $sourcePath, $name = null, $filters = [], AssetFactory $assetFactory = null)
    {
        $dep = null;
        if ($pattern instanceof static) {
            $dep = $pattern;
        } else {
            foreach ([$assetFactory, $this->getAssetFactory()] as $factory) {
                if ($factory->hasPattern($pattern)) {
                    $dep = $factory->file($pattern, $sourcePath, $name, $filters);
                    break;
                }
            }
        }
        $this->dependencies[] = $dep;
        return $this;
    }

    /**
     * @return Asset[]
     */
    public function getDependencies()
    {
        return $this->dependencies;
    }

    public function dump()
    {
        foreach ($this->getFilters() as $filter) {
            $filter->dump($this);
        }
        return $this->getContent();
    }

    public function hash()
    {
        $hashArray = [$this->sourcePath];
        foreach ($this->filters as $filter) {
            $hashArray[] = $filter->hash();
        }
        return implode('|', $hashArray);
    }

    public function getTargetPath()
    {
        $hash = substr(md5($this->hash()), 0, 7);
        return str_replace('*', $hash, $this->targetPath);
    }

    public function outputTo($path)
    {
        $this->targetPath = $path;
    }
}