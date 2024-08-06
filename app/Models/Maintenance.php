<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'damaged',
        'cost_maintenance',
        'maintenance_manager',
        'maintenance_date',
        'counter_number',
        'vehicle_id',
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\User','maintenance_manager');
    }

    public function vehicle()
    {
        return $this->belongsTo('App\Models\Vehicle','vehicle_id');
    }

}
