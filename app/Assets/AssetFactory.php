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

    protected static $cache = [];

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
        foreach (array_merge($pattern->getFilters(), $filters) as $filter) {
            if (!$filter instanceof BaseFilter) {
                $filter = $this->filterManager()->get($filter);
            }
            if ($filter) {
                $resultFilters[] = $filter;
            }
        }
        $asset = new Asset($name, $fullSourcePath, $pattern->getTargetPath(), $resultFilters);
        $asset->setAssetFactory($this);
        return $asset;
    }
}