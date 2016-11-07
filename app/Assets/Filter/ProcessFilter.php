<?php

namespace App\Assets\Filter;

use App\Assets\Asset;
use App\Assets\Exception\ProcessFailed;
use Symfony\Component\Process\Process;

abstract class ProcessFilter extends BaseFilter
{
    abstract protected function buildCommand(Asset $asset);

    public function dump(Asset $asset)
    {
        $process = new Process($this->buildCommand($asset));
        $process->setInput($asset->content());
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailed(sprintf(
                'Process error. File: %s, Filter: %s, Error: %s',
                $asset->sourcePath(),
                get_class($this),
                $process->getErrorOutput()
            ));
        }
        $asset->setContent($process->getOutput());
    }
}