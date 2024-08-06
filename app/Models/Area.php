<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    public function parent()
    {
        return $this->belongsTo(Area::class, 'parint')->select('*');
    }

    public function children()
    {
        return $this->hasMany(Area::class, 'parint')->select('*');
    }

    // recursive, loads all descendants
    public function childrenAreas()
    {
        return $this->children()->with('childrenAreas');
    }

    public function parentAreas()
    {
        return $this->parent()->with('parentAreas');
    }

}
