<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PossibleExpenses extends Model
{
    use HasFactory;

    protected $fillable = [
        'expense_name',
        'cost',
        'expense_type',
    ];

}
