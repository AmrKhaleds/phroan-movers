<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyMoveItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function account()
    {
        return $this->belongsTo('App\Models\Account','account_id');
    }
    public function dailymove()
    {
        return $this->belongsTo('App\Models\DailyMove','daily_move_id');
    }
}
