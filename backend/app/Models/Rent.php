<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant',
        'no_car',
        'date_borrow',
        'date_return',
        'down_payment',
        'discount',
        'total',
    ];
}
