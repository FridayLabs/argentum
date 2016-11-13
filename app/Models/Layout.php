<?php

namespace App\Models;

use App\Structure\HasStructureAttribute;
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
