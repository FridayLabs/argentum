<?php

namespace App\Assets;

class AssetManager
{
    protected $assets = [];
    protected $namedAssets = [];

    public function addAsset(Asset $asset)
    {
        $this->assets[$asset->hash()] = $asset;
        $this->namedAssets[$asset->getName()] = $asset;
        $this->addAssets($asset->getDependencies());
        return $this;
    }

    public function addAssets(array $assets)
    {
        foreach ($assets as $asset) {
            $this->addAsset($asset);
        }
        return $this;
    }

    public function has($name)
    {
        return isset($this->namedAssets[$name]);
    }

    public function get($name)
    {
        if ($this->has($name)) {
            return $this->namedAssets[$name];
        }
    }

    /**
     * @param bool $sorted
     * @return Asset[]
     */
    public function getAssets($sorted = true)
    {
        return $sorted ? $this->sortAssets($this->assets) : $this->assets;
    }

    public function getStyles($sorted = true)
    {
        $assets = $this->getAssets($sorted);
        return array_filter($assets, function (Asset $asset) {
            return ends_with($asset->getTargetPath(), '.css');
        });
    }

    public function getScripts($sorted = true)
    {
        $assets = $this->getAssets($sorted);
        return array_filter($assets, function (Asset $asset) {
            return ends_with($asset->getTargetPath(), '.js');
        });
    }

    protected function sortAssets($assets)
    {
        $result = [];
        foreach ($assets as $asset) {
            $stack = [$asset->hash()];
            while ($stack) {
                $assetHash = array_pop($stack);
                foreach ($this->assets[$assetHash]->getDependencies() as $dependency) {
                    $depHash = $dependency->hash();
                    if (in_array($depHash, $stack)) {
                        throw new \Exception('Cycle dependency on ' . $dependency->getName());
                    }
                    $stack[] = $depHash;
                }
                if (!in_array($assetHash, $result)) {
                    $result[] = $assetHash;
                }
            }
        }
        return array_map(function ($hash) {
            return $this->assets[$hash];
        }, array_reverse($result));
    }
}