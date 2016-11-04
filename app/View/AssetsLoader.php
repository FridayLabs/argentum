<?php

namespace App\View;

use App\Assets\AssetFactory;
use App\Assets\AssetManager;
use App\Structure\Node\HasView;
use App\Structure\Node\Node;
use App\Structure\Node\RequiresAssets;
use App\Structure\Structure;

class AssetsLoader
{
    /**
     * @var AssetManager
     */
    protected $manager;

    /**
     * @var AssetFactory
     */
    protected $factory;

    public function __construct($assetManager, $assetFactory)
    {
        $this->manager = $assetManager; // app(AssetManager::class);
        $this->factory = $assetFactory; //app(AssetFactory::class);
    }

    public function loadAssets(Structure $structure)
    {
        $this->load($structure->tree());
    }

    protected function load(Node $node)
    {
        foreach ($node->children() as $child) {
            $this->load($child);
        }
        if ($node instanceof RequiresAssets) {
            $this->manager->addAssets($node->assets($this->factory));
        }
        if ($node instanceof HasView) {
            $vuePath = node_path('vue/dist/vue.min.js');
            $this->manager->addAssets([
                $node->configurationAsset($this->factory)->dependsOn('js', $vuePath),
                $node->componentAsset($this->factory)->dependsOn('js', $vuePath)
            ]);
        }
    }
}