<?php

namespace App\GraphQL\Mutations;

use App\Models\Vehicle;
use App\Models\VipVehicle;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CreateVIPVehicle
{
  public function __invoke($_, array $args)
  {
    return DB::transaction(function () use ($args) {
      // Validasi type kendaraan hanya mobil atau motor
      $type = 'mobil'; // default VIP hanya untuk mobil, bisa diubah jika perlu

      // 1. Simpan kendaraan baru
      $vehicle = Vehicle::create([
        'license_plate' => $args['license_plate'],
        'type' => $type,
        'owner_name' => $args['owner_name'],
      ]);

      // 2. Generate barcode
      $barcode = 'BR-' . strtoupper(str_replace(' ', '', $vehicle->license_plate)) . '-' . Str::random(6);
      $vehicle->barcode = $barcode;
      $vehicle->save();

      // 3. Simpan info VIP di tabel vip_vehicle
      VipVehicle::create([
        'vehicle_id' => $vehicle->id,
        'vip_level' => $args['vip_level'],
        'vip_expiry_date' => $args['vip_expiry_date'],
      ]);

      // 4. Kembalikan objek kendaraan
      return $vehicle;
    });
  }
}
