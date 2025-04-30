<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;

class Order extends Model
{


    protected $fillable = [
        'name',
        'phone',
        'items',
        'total',
    ];

    protected $casts = [
        'items' => 'array', // Cast JSON to array
    ];
}
