<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyMove extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function dailyMoveItem()
    {
        return $this->hasMany('App\Models\DailyMoveItem','daily_move_id');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch','branch_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo('App\Models\PaymentsMethod','payments_method_id','id');
    }

    public function created_by_user()
    {
        return $this->belongsTo('App\Models\User','created_by','id');
    }

}
