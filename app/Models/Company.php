<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'logo',
        'phone',
        'whatsapp',
        'address',
        'manger',
    ];

    public function booking()
    {
        return $this->hasMany('App\Models\Booking','company_id','id');
    }
}
