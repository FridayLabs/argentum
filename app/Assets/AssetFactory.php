<?php

namespace App\Assets;

use App\Assets\Exception\FileNotFound;
use App\Assets\Exception\FileNotReadable;
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
        if ($name === null) {
            return $this->file($pattern, $sourcePath, $sourcePath, $filters);
        }
        if (is_array($name)) {
            return $this->file($pattern, $sourcePath, null, $name);
        }
        $sourcePath = $this->resolveNamespace($sourcePath);
        $fullSourcePath = $this->normalizeSourcePath($sourcePath);
        $this->validatePath($fullSourcePath);
        $pattern = $this->getPattern($pattern);

        $resultFilters = $this->mergeFilters($pattern->filters(), $filters);
        $asset = new Asset($name, $pattern->targetPath(), $fullSourcePath, $resultFilters);
        $asset->setAssetFactory($this);

        return $asset;
    }

    public function string($pattern, $content, $name = null, $filters = [])
    {
        if ($name === null) {
            $name = md5($content);
        }
        if (is_array($name)) {
            return $this->string($pattern, $content, null, $name);
        }
        $pattern = $this->getPattern($pattern);
        $resultFilters = $this->mergeFilters($pattern->filters(), $filters);

        $asset = new Asset($name, $pattern->targetPath(), null, $resultFilters);
        $asset->setContent($content);
        $asset->setAssetFactory($this);

        return $asset;
    }

    /**
     * @param $sourcePath
     * @return string
     * @throws \Exception
     */
    protected function resolveNamespace($sourcePath)
    {
        if (strpos($sourcePath, '::') !== false) {
            list($namespace, $path) = explode('::', $sourcePath);
            if (!isset($this->namespaces[$namespace])) {
                throw new \Exception('Unknown namespace ' . $namespace . ' in ' . $sourcePath);
            }
            $sourcePath = $this->namespaces[$namespace] . '/' . $path;
            return $sourcePath;
        }
        return $sourcePath;
    }

    /**
     * @param $sourcePath
     * @return string
     * @throws \Exception
     */
    protected function normalizeSourcePath($sourcePath)
    {
        return !starts_with($sourcePath, '/') ? $this->assetsDir . '/' . $sourcePath : $sourcePath;
    }

    /**
     * @param $patternFilters
     * @param $filters
     * @return array
     */
    protected function mergeFilters($patternFilters, $filters)
    {
        $resultFilters = [];
        foreach (array_merge($patternFilters, $filters) as $filter) {
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
        return $resultFilters;
    }

    /**
     * @param $sourcePath
     * @param $fullSourcePath
     * @throws \Exception
     */
    protected function validatePath($fullSourcePath)
    {
        if (!file_exists($fullSourcePath)) {
            throw new FileNotFound("Source {$fullSourcePath} is not exists");
        }
        if (!is_readable($fullSourcePath)) {
            throw new FileNotReadable("Source {$fullSourcePath} is not readable");
        }
    }

    /**
     * @param $pattern
     * @return AssetPattern
     * @throws \Exception
     */
    protected function getPattern($pattern)
    {
        if (!$pattern instanceof AssetPattern) {
            if (!isset($this->assetPatterns[$pattern])) {
                throw new \Exception("Unknown asset type {$pattern}");
            }
            $pattern = $this->assetPatterns[$pattern];
            return $pattern;
        }
        return $pattern;
    }
}
