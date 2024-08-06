<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'client_phone',
        'client_phone2',
        'received_by_phone',
        'booking_at',
        'order_time',
        'from_area',
        'order_day',
        'to_area',
        'nanonal_id',
        'price',
        'from_floor',
        'to_floor',
        'assanger',
        'ladder_wide',
        'corridor',
        'check_winch_up',
        'check_winch_down',
        'load_car',
        'expenses',
        'service',
        'discount',
        'discount_reson',
        'increese',
        'increese_reson',
        'tips',
        'know_through',
        'received_phone',
        'status',
        'note_canceled',
        'vehicle_id',
        'driver_id',
        'assign_car_id',
        'assign_at',
        'company_id',
        'type_company',
        'created_by',
        'updated_by',
        'note',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User','created_by');
    }


    public function updatedUser()
    {
        return $this->belongsTo('App\Models\User','updated_by');
    }

    public function assign()
    {
        return $this->belongsTo('App\Models\AssignCar','vehicle_id','vehicle_id')->latest();
    }

    public function assigned()
    {
        return $this->hasMany('App\Models\AssignCar','booking_id','id')->latest();
    }

    public function rate()
    {
        return $this->belongsTo('App\Models\Rate','id','booking_id');
    }

    public function fromArea()
    {
        return $this->belongsTo('App\Models\Area','from_area','id');
    }
    public function toArea()
    {
        return $this->belongsTo('App\Models\Area','to_area','id');
    }

    public function order_expense()
    {
        return $this->hasMany('App\Models\OrderExpense');
    }
}
