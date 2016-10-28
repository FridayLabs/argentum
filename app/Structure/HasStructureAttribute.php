<?php

namespace App\Structure;

trait HasStructureAttribute
{
    public function getStructureAttribute($value)
    {
        return new Structure($value);
    }

    public function setStructureAttribute($value)
    {
        if (is_array($value)) {
            $value = Structure::encode($value);
        }
        if ($value instanceof Structure) {
            $value = Structure::encode($value->toArray());
        }
        $this->attributes['structure'] = $value;
    }
}
