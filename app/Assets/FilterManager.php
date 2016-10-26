<?php

namespace App\Assets;

use App\Assets\Filter\BaseFilter;

class FilterManager
{
    protected $filters = [];

    public function set($name, BaseFilter $filter)
    {
        $this->filters[$name] = $filter;
    }

    public function has($name)
    {
        return isset($this->filters[$name]);
    }

    public function get($name)
    {
        if ($this->has($name)) {
            return $this->filters[$name];
        }
    }
}