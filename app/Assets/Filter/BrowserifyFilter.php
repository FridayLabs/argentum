<?php

namespace App\Assets\Filter;

use App\Assets\Asset;

class BrowserifyFilter extends ProcessFilter
{
    protected $browserifyExec;
    protected $nodeExecutable;

    protected $transformers = [];

    public function __construct($browserifyExec, $nodeExecutable)
    {
        $this->browserifyExec = $browserifyExec;
        $this->nodeExecutable = $nodeExecutable;
    }

    public function addTransformer($transformer)
    {
        $this->transformers[] = $transformer;
    }

    protected function buildCommand(Asset $asset)
    {
        $command = $this->nodeExecutable . ' ' . $this->browserifyExec .
            ($this->transformers ? ' -t ' . implode(' -t ', $this->transformers) : '') .
            ($asset->sourcePath() ? ' -e ' . $asset->sourcePath() : ' - ');
        return $command;
    }
}
