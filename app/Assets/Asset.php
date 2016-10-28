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

    /**
     * @return AssetFactory
     */
    public function assetFactory()
    {
        return $this->assetFactory;
    }

    public function name()
    {
        return $this->name;
    }

    public function sourcePath()
    {
        return $this->sourcePath;
    }

    public function content()
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
    public function filters()
    {
        return $this->filters;
    }

    public function setFilters(array $filters = [])
    {
        $this->filters = $filters;

        return $this;
    }

    public function dependsOn($pattern, $sourcePath = null, $name = null, $filters = [], AssetFactory $assetFactory = null)
    {
        // ->(new Asset(...))
        if ($pattern instanceof static) {
            $this->dependencies[] = $pattern;

            return $this;
        }

        // ->('less', 'source', ...)
        foreach ([$assetFactory, $this->assetFactory()] as $factory) {
            if ($factory && $factory->hasPattern($pattern)) {
                $this->dependencies[] = $factory->file($pattern, $sourcePath, $name, $filters);

                return $this;
            }
        }

        // ->('name')
        // ->('src/file.css')
        if (count(func_get_args()) !== 1) {
            throw new \Exception('Pass exactly one argument to reference asset');
        }
        foreach ([$assetFactory, $this->assetFactory()] as $factory) {
            if ($factory) {
                $this->dependencies[] = (string) $pattern;

                return $this;
            }
        }

        return $this;
    }

    /**
     * @return Asset[]|string[]
     */
    public function dependencies()
    {
        return $this->dependencies;
    }

    public function resolveDependency($name, Asset $asset)
    {
        foreach ($this->dependencies as &$dependency) {
            if ($dependency === $name) {
                $dependency = $asset;
            }
        }
    }

    public function dump()
    {
        foreach ($this->filters() as $filter) {
            $filter->dump($this);
        }

        return $this->content();
    }

    public function hash()
    {
        $hashArray = [$this->sourcePath];
        foreach ($this->filters as $filter) {
            $hashArray[] = $filter->hash();
        }

        return implode('|', $hashArray);
    }

    public function targetPath()
    {
        $hash = substr(md5($this->hash()), 0, 7);

        return str_replace('*', $hash, $this->targetPath);
    }

    public function outputTo($path)
    {
        $this->targetPath = $path;
    }
}
