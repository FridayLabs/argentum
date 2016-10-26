<?php

namespace App\Assets;

class AssetPattern
{
    protected $targetPath;
    protected $filters;
    protected $options;

    public function __construct($targetPath, $filters = [], array $options = [])
    {
        $this->targetPath = $targetPath;
        $this->filters = (array)$filters;
        $this->options = $options;
    }

    /**
     * @return mixed
     */
    public function getTargetPath()
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
    public function getFilters()
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

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }
}