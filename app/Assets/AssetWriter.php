<?php

namespace Argentum\Assets;

abstract class AssetWriter
{
    abstract public function writeManagerAssets(AssetManager $manager);

    abstract public function writeAsset(Asset $asset);
}
