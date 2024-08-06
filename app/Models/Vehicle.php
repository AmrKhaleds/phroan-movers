<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = [
        'type_car',
        'car_name',
        'model_car',
        'vehicle_number',
        'license_num',
        'license_to',
        'status',
    ];

    public function assign()
    {
        return $this->belongsTo('App\Models\AssignCar','id','vehicle_id')->latest();
    }

}
