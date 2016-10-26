<?php

namespace App\Assets;

use App\Assets\Asset\BaseAsset;
use App\Assets\Asset\CssFileAsset;
use App\Assets\Asset\LessFileAsset;

class AssetFactory
{
    protected $assetsDir;

    /**
     * @var FilterManager
     */
    protected $filterManager;

    public function __construct($assetsDir)
    {
        $this->assetsDir = $assetsDir;
    }

    public function getFilterManager()
    {
        return $this->filterManager;
    }

    public function setFilterManager(FilterManager $filterManager)
    {
        $this->filterManager = $filterManager;
    }

    protected function asset($sourcePath, $type, $name = null, array $filters = [])
    {
        $name = $name ?: $sourcePath;
        $fullSourcePath = realpath($this->assetsDir . '/' . $sourcePath);
        if (!file_exists($fullSourcePath)) {
            throw new \Exception("Source {$sourcePath} is not exists");
        }
        if (!is_readable($fullSourcePath)) {
            throw new \Exception("Source {$sourcePath} is not readable");
        }
        $managerFilters = $this->getFilterManager()->getFiltersForType($type);
        $asset = new $type($name, $fullSourcePath, array_merge($managerFilters, $filters));
        $asset->setAssetFactory($this);
        return $asset;
    }

    /**
     * @param $sourcePath
     * @param null $name
     * @param array $filters
     * @return CssFileAsset
     * @throws \Exception
     */
    public function css($sourcePath, $name = null, array $filters = [])
    {
        return $this->asset($sourcePath, CssFileAsset::class, $name, $filters);
    }

    /**
     * @param $sourcePath
     * @param null $name
     * @param array $filters
     * @return LessFileAsset
     */
    public function less($sourcePath, $name = null, array $filters = [])
    {
        return $this->asset($sourcePath, LessFileAsset::class, $name, $filters);
    }


    /**
     * @param $sourcePath
     * @param null $name
     * @param array $filters
     * @return BaseAsset
     * @throws \Exception
     */
    public function file($sourcePath, $name = null, array $filters = [])
    {
        $method = $this->guessFactoryMethod($sourcePath);
        if (!method_exists($this, $method)) {
            throw new \Exception("Unsupported type {$method} for {$sourcePath}");
        }
        return $this->{$method}($sourcePath, $name, $filters);
    }

    protected function guessFactoryMethod($path)
    {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        switch ($ext) {
            case 'css':
            case 'less':
                return $ext;
        }
    }
}