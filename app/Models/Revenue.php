<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    use HasFactory;


    public function booking()
    {
        return $this->belongsTo('App\Models\Booking','booking_id','id');
    }

}
