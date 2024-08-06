<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'payroll_type',
        'payroll_value',
        'type_value',
        'val',
        'reason',
        'status',
        'set_month',
        'user_id',
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

}
