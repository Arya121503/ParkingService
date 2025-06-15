<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    protected $fillable = [
        'license_plate',
        'type',
        'owner_name',
        'vehicle_model',
        'barcode',
    ];

    protected static function booted()
    {
        static::creating(function ($vehicle) {
            $allowedTypes = ['mobil', 'motor'];
            if (!in_array(strtolower($vehicle->type), $allowedTypes)) {
                throw new \InvalidArgumentException("Jenis kendaraan harus 'mobil' atau 'motor'.");
            }

            // Barcode generator
            $plate = strtoupper(str_replace(' ', '', $vehicle->license_plate));
            $timestamp = now()->format('His');
            $vehicle->barcode = $plate . '-' . $timestamp;
        });
    }

    public function vipInfo(): HasOne
    {
        return $this->hasOne(VipVehicle::class, 'vehicle_id');
    }

    public function parkingRecords(): HasMany
    {
        return $this->hasMany(ParkingRecord::class);
    }
}
