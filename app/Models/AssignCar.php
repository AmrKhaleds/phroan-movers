<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignCar extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'counter_number',
        'description',
        'created_by',
        'updated_by',
        'crane_id',
        'vehicle_id',
        'carpenter_id',
        'wrapping_id',
        'HVAC_technician_id',
        'worker_id',
        'booking_id',
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function crane()
    {
        return $this->belongsTo('App\Models\Vehicle','crane_id');
    }

    public function car()
    {
        return $this->belongsTo('App\Models\Vehicle','car_id');
    }
    public function vehicle()
    {
        return $this->belongsTo('App\Models\Vehicle','vehicle_id');
    }

}
