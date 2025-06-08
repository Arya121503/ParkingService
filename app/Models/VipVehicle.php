<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VipVehicle extends Model
{
    protected $table = 'vip_vehicle';

    protected $fillable = [
        'vehicle_id',
        'vip_level',
        'vip_expiry_date',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
}
