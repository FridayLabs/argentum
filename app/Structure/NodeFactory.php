<?php

namespace App\Structure;

class NodeFactory
{
    public function registerNodeClass($type, $nodeClass)
    {
        if (isset($this->nodeClasses[$type])) {
            throw new \Exception('Node '.$type.' already defined');
        }
        $this->nodeClasses[$type] = $nodeClass;
    }

    protected function getNodeClass($type)
    {
        return array_get($this->nodeClasses, $type, Node::class);
    }

    public function make(array $nodeData)
    {
        $class = $this->getNodeClass($nodeData['type']);

        return new $class($nodeData['type'], array_get($nodeData, 'config', []));
    }
}
