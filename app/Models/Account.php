<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory;
    use SoftDeletes;


    public function scopeParent($query)
    {
        return $query->where('accounts.parent_id', '0');
    }

    public function scopeMaster($query)
    {
        return $query->where('accounts.master', '0');
    }


    public function parent()
    {
        return $this->belongsTo(Account::class, 'parent_id')->select('*');
    }

    public function masters()
    {
        return $this->belongsTo(Account::class, 'master')->select('*');
    }


    public function children()
    {
        return $this->hasMany(Account::class, 'parent_id')->select('*');
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

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch','branch_id');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client','num','account_num');
    }

    public function daily_move_items()
    {
        return $this->hasMany('App\Models\DailyMoveItem','account_id','id');
    }

}
