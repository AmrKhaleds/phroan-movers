<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderExpense extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'cost',
        'reason',
        'expense_type',
        'deposit',
    ];


    public function booking()
    {
        return $this->belongsTo('App\Models\Booking','booking_id');
    }

}
