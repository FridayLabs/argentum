<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function layouts()
    {
        return $this->hasMany(Layout::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }
}
