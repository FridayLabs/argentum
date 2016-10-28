<?php

namespace App\Assets;

class AssetManager
{
    protected $assets = [];
    protected $namedAssets = [];

    public function addAsset($asset)
    {
        if ($asset instanceof Asset) {
            $this->assets[$asset->hash()] = $asset;
            $this->namedAssets[$asset->name()] = $asset;
            $this->addAssets($asset->dependencies());
        }

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
     *
     * @return Asset[]
     */
    public function assets($sorted = true)
    {
        array_map([$this, 'resolveDependencies'], $this->assets);

        return $sorted ? $this->sortAssets($this->assets) : $this->assets;
    }

    public function styles($sorted = true)
    {
        $assets = $this->assets($sorted);

        return array_filter($assets, function (Asset $asset) {
            return ends_with($asset->targetPath(), '.css');
        });
    }

    public function scripts($sorted = true)
    {
        $assets = $this->assets($sorted);

        return array_filter($assets, function (Asset $asset) {
            return ends_with($asset->targetPath(), '.js');
        });
    }

    protected function resolveDependencies($asset)
    {
        if ($dependencies = $asset->dependencies()) {
            foreach ($dependencies as $dependency) {
                if (is_string($dependency)) {
                    if ($this->has($dependency)) {
                        $asset->resolveDependency($dependency, $this->get($dependency));
                    } else {
                        throw new \Exception('Unknown dependency '.$dependency);
                    }
                } else {
                    $this->resolveDependencies($dependency);
                }
            }
        }
    }

    protected function sortAssets($assets)
    {
        $sorted = $visited = [];
        foreach ($assets as $asset) {
            if (!isset($visited[$asset->hash()])) {
                $this->visit($asset, $sorted, $visited);
            }
        }

        return $sorted;
    }

    protected function visit($asset, &$sorted, &$marked)
    {
        $hash = $asset->hash();
        if (isset($marked[$hash])) {
            throw new \Exception('Circular dependency');
        }
        $marked[$hash] = true;
        foreach ($asset->dependencies() as $dependency) {
            $this->visit($dependency, $sorted, $marked);
        }
        unset($marked[$hash]);
        if (!isset($sorted[$hash])) {
            $sorted[$hash] = $asset;
        }
    }
}
