<?php

namespace App\Assets;

use App\Assets\Filter\BaseFilter;

class FilterManager
{
    protected $filters = [];
    protected $typeFiltersMap = [];

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

    public function setFiltersForType($type, array $filters)
    {
        $bindings = [];
        foreach ($filters as $filter) {
            if ($filter instanceof BaseFilter) {
                $name = $filter->hash();
                $this->set($name, $filter);
                $filter = $name;
            } elseif (!$this->has($filter)) {
                throw new \Exception("Filter {$filter} is not exists. So can't be bind to any type");
            }
            $bindings[] = $filter;
        }
        $this->typeFiltersMap[$type] = $bindings;
    }

    public function getFiltersForType($type)
    {
        if (isset($this->typeFiltersMap[$type])) {
            return array_map([$this, 'get'], $this->typeFiltersMap[$type]);
        }
        return [];
    }
}