<?php

namespace App\Assets\Filter;

use App\Assets\Asset;

class BabelFilter extends ProcessFilter
{
    protected $babelExecutable;
    protected $nodeExecutable;

    protected $presets = [];

    public function __construct($babelExecutable, $nodeExecutable)
    {
        $this->babelExecutable = $babelExecutable;
        $this->nodeExecutable = $nodeExecutable;
    }

    public function addPreset($preset)
    {
        $this->presets[] = $preset;
    }

    protected function buildCommand(Asset $asset)
    {
        $command = $this->nodeExecutable . ' ' . $this->babelExecutable .
            ($this->presets ? ' --presets=' . implode(',', $this->presets) : '');
        return $command;
    }
}
