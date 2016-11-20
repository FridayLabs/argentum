<?php

namespace Argentum\Model;

use Argentum\Structure\HasStructureAttribute;
use Illuminate\Database\Eloquent\Model;

class Layout extends Model
{
    use HasStructureAttribute;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }
}
