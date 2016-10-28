<?php

namespace App\Models;

use App\Structure\HasStructureAttribute;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasStructureAttribute;

    public function layout()
    {
        return $this->belongsTo(Layout::class);
    }

    public function getStructureWithLayout()
    {
        $layout = clone $this->layout->structure;
        $slot = $layout->getContentSlot();
        array_map([$slot, 'addChild'], $this->structure->getTree()->getChildren());

        return $layout;
    }
}
