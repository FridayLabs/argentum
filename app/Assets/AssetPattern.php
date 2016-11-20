<?php

namespace Argentum\Assets;

class AssetPattern
{
    protected $targetPath;
    protected $filters;
    protected $options;

    public function __construct($targetPath, $filters = [], array $options = [])
    {
        $this->targetPath = $targetPath;
        $this->filters = (array) $filters;
        $this->options = $options;
    }

    /**
     * @return mixed
     */
    public function targetPath($sourcePath)
    {
        return $this->targetPath;
    }

    /**
     * @param mixed $targetPath
     */
    public function setTargetPath($targetPath)
    {
        $this->targetPath = $targetPath;
    }

    /**
     * @return array
     */
    public function filters()
    {
        return $this->filters;
    }

    /**
     * @param array $filters
     */
    public function setFilters($filters)
    {
        $this->filters = $filters;
    }
}
