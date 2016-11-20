<?php

namespace Argentum\Model;

use Argentum\Structure\HasStructureAttribute;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasStructureAttribute;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function layout()
    {
        return $this->belongsTo(Layout::class);
    }

    public function getStructureWithLayout()
    {
        $layout = clone $this->layout->structure;
        $slot = $layout->subtreeSlot();
        array_map([$slot, 'addChild'], $this->structure->tree()->children());

        return $layout;
    }
}
