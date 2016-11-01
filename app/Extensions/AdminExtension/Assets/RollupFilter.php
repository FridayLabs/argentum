<?php

namespace App\Extensions\AdminExtension\Assets;

use App\Assets\Asset;
use App\Assets\Filter\BaseFilter;
use Symfony\Component\Process\Process;

class RollupFilter extends BaseFilter
{
    protected $rollupExecutable;
    protected $nodeExecutable;

    protected $format;

    protected $config;

    public function __construct($rollupExecutable, $nodeExecutable)
    {
        $this->rollupExecutable = $rollupExecutable;
        $this->nodeExecutable = $nodeExecutable;
    }

    public function setFormat($format)
    {
        $this->format = $format;
    }

    protected function buildCommand(Asset $asset)
    {
        $command = $this->nodeExecutable . ' ' . $this->rollupExecutable .
            ($this->format ? ' -f ' . $this->format : '') .
            ' -i ' . $asset->sourcePath();
        return $command;
    }

    public function dump(Asset $asset)
    {
        $assetDir = dirname($asset->sourcePath());
        $process = new Process($this->buildCommand($asset), $assetDir);
        $process->setInput($asset->content());
        $process->run();
        if ($process->isSuccessful()) {
            $asset->setContent($process->getOutput());
        } else {
            throw new \Exception('Rollup error. ' . $process->getErrorOutput());
        }
    }
}