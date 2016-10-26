<?php

namespace App\Assets;

use App\Assets\Asset\BaseAsset;

class AssetManager
{
    protected $assets = [];
    protected $namedAssets = [];

    public function addAsset(BaseAsset $asset)
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


    public function getAssets()
    {

        $assets = $this->sortAssets($this->assets);
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
                if (!isset($result[$assetHash])) {
                    $result[] = $assetHash;
                }
            }
        }
        return $result;
    }
}