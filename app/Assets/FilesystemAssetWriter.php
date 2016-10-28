<?php

namespace App\Assets;

class FilesystemAssetWriter
{
    protected $outputDir;

    public function __construct($outputDir)
    {
        $this->outputDir = $outputDir;
    }

    public function writeManagerAssets(AssetManager $manager)
    {
        foreach ($manager->assets(false) as $asset) {
            $this->writeAsset($asset);
        }
    }

    public function writeAsset(Asset $asset)
    {
        $content = $asset->dump();
        $path = $this->outputDir.'/'.$asset->targetPath();
        $dir = dirname($path);
        if (!@mkdir($dir, 0777, true) && !is_dir($dir)) {
            throw new \Exception("Can't create dir {$dir}");
        }
        file_put_contents($path, $content);
    }
}
