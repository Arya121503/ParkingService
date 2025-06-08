<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParkingRate extends Model
{
    protected $fillable = [
        'type',
        'vip_only',
        'daily_rate',
    ];
}

