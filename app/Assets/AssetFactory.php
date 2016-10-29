<?php

namespace App\Assets;

use App\Assets\Filter\BaseFilter;

class AssetFactory
{
    protected $assetsDir;

    /**
     * @var AssetPattern[]
     */
    protected $assetPatterns = [];

    /**
     * @var FilterManager
     */
    protected $filterManager;

    protected $namespaces = [];

    public function __construct($assetsDir)
    {
        $this->assetsDir = $assetsDir;
    }

    public function filterManager()
    {
        return $this->filterManager;
    }

    public function setFilterManager(FilterManager $filterManager)
    {
        $this->filterManager = $filterManager;
    }

    public function setNamespace($name, $path)
    {
        $this->namespaces[$name] = $path;
    }

    public function setPattern($name, AssetPattern $pattern)
    {
        $this->assetPatterns[$name] = $pattern;
    }

    public function hasPattern($name)
    {
        return isset($this->assetPatterns[$name]);
    }

    public function file($pattern, $sourcePath, $name = null, $filters = [])
    {
        $name = $name ?: $sourcePath;

        if (strpos($sourcePath, '::') !== false) {
            list($namespace, $path) = explode('::', $sourcePath);
            if (!isset($this->namespaces[$namespace])) {
                throw new \Exception('Unknown namespace ' . $namespace . ' in ' . $sourcePath);
            }
            $sourcePath = $this->namespaces[$namespace] . '/' . $path;
        }
        $fullSourcePath = realpath(!starts_with($sourcePath, '/') ? $this->assetsDir . '/' . $sourcePath : $sourcePath);
        if (!file_exists($fullSourcePath)) {
            throw new \Exception("Source {$sourcePath} is not exists");
        }
        if (!is_readable($fullSourcePath)) {
            throw new \Exception("Source {$sourcePath} is not readable");
        }
        if (!$pattern instanceof AssetPattern) {
            if (!isset($this->assetPatterns[$pattern])) {
                throw new \Exception("Unknown asset type {$pattern}");
            }
            $pattern = $this->assetPatterns[$pattern];
        }

        $resultFilters = [];
        foreach (array_merge($pattern->filters(), $filters) as $filter) {
            if (!$filter instanceof BaseFilter) {
                if (is_string($filter) && starts_with($filter, '?') && env('APP_DEBUG', false)) {
                    continue;
                }
                $filter = $this->filterManager()->get($filter);
            }
            if ($filter) {
                $resultFilters[] = $filter;
            }
        }
        $asset = new Asset($name, $fullSourcePath, $pattern->targetPath(), $resultFilters);
        $asset->setAssetFactory($this);

        return $asset;
    }
}
