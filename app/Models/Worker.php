<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'phone',
        'job_type',
        'phone2',
        'parent_id',
    ];



    public function scopeParent($query)
    {
        return $query->where('workers.parent_id', '0');
    }

    public function parent()
    {
        return $this->belongsTo(Worker::class, 'parent_id')->select('*');
    }

    public function children()
    {
        return $this->hasMany(Worker::class, 'parent_id')->select('*');
    }

    // recursive, loads all descendants
    public function childrenAccounts()
    {
        return $this->children()->with('childrenAccounts');
    }

    public function parentAccounts()
    {
        return $this->parent()->with('parentAccounts');
    }
    public function masterAccounts()
    {
        return $this->masters()->with('masterAccounts');
    }


}
