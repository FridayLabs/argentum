<?php

namespace Argentum\Composer;

use Argentum\Assets\AssetFactory;
use Argentum\Structure\Node\HasView;
use Argentum\Structure\Node\Node;
use Argentum\Structure\Node\RequiresAssets;
use Argentum\Structure\Structure;

class PageComposer
{
    protected $structure;

    public function __construct(Structure $structure)
    {
        $this->structure = $structure;
    }

    protected function walk(Node $node, callable $in, callable $out = null)
    {
        $in($node);
        foreach ($node->children() as $child) {
            $this->walk($child, $in, $out);
        }
        if ($out) {
            $out($node);
        }
    }

    public function markup()
    {
        $markup = [];
        $this->walk(
            $this->structure->tree(),
            function (Node $node) use (&$markup) {
                if ($node instanceof HasView) {
                    $config = [];
                    foreach ($node->config() as $configName => $configItem) {
                        $configItem = json_encode($configItem);
                        if (!is_bool($configItem)) {
                            $configItem = '\'' . $configItem . '\'';
                        }
                        $config[] = ':' . $configName . '=' . $configItem;
                    }
                    $config = implode(' ', $config);
                    $markup[] = "<{$node->type()} $config>";
                }
            },
            function (Node $node) use (&$markup) {
                if ($node instanceof HasView) {
                    $markup[] = "</{$node->type()}>";
                }
            }
        );
        return implode('', $markup);
    }

    public function assets(AssetFactory $factory)
    {
        $assets = [
            $factory->file('css', vendor_path('bower-asset/normalize.css/normalize.css')),
            $factory->file('js', node_path('vue/dist/vue.min.js'), 'vuejs'),
            $factory->file('vue', 'app/app.js', 'app')->dependsOn(
                $this->componentsAsset($factory)->dependsOn('vuejs')
            )
        ];
        $this->walk($this->structure->tree(), function (Node $node) use (&$assets, $factory) {
            if ($node instanceof RequiresAssets) {
                $assets = array_merge($assets, $node->assets($factory));
            }
        });
        return $assets;
    }

    public function componentsAsset(AssetFactory $factory)
    {
        $asset = [
            'window.components = {};'
        ];
        $this->walk($this->structure->tree(), function (Node $node) use (&$asset, $factory) {
            if ($node instanceof HasView) {
                $sourcePath = $node->componentAsset($factory)->sourcePath();
                $asset[] = "components['{$node->type()}'] = require('{$sourcePath}');";
            }
        });
        return $factory->string('vue', implode('', $asset));
    }
}
