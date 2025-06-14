<?php

namespace App\GraphQL\Mutations;

use App\Models\Vehicle;
use App\Models\VipVehicle;
use App\Models\Barcode;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CreateVIPVehicle
{
  public function __invoke($_, array $args)
  {
    return DB::transaction(function () use ($args) {
      // 1. Cek apakah model kendaraan termasuk kategori VIP
      $vipModels = ['Lamborghini Aventador', 'Lamborghini Urus', 'Ferrari F8', 'Rolls Royce Ghost'];
      $isVip = in_array($args['vehicle_model'], $vipModels);

      // 2. Buat kendaraan baru
      $vehicle = Vehicle::create([
        'license_plate' => $args['license_plate'],
        'type' => $args['type'],
        'vehicle_model' => $args['vehicle_model'],
        'owner_name' => $args['owner_name'],
      ]);

      // 3. Generate barcode
      $barcode = 'BR-' . strtoupper(str_replace(' ', '', $vehicle->license_plate)) . '-' . Str::random(6);
      $vehicle->barcode = $barcode;
      $vehicle->save();

      // 4. Simpan ke tabel barcodes (relasi tabel satu-ke-satu atau banyak-ke-satu)
      Barcode::create([
        'vehicle_id' => $vehicle->id,
        'barcode_data' => $barcode,
        'issued_date' => now(),
      ]);

      // 5. Simpan info VIP (jika model termasuk VIP)
      if ($isVip) {
        VipVehicle::create([
          'vehicle_id' => $vehicle->id,
          'vip_level' => 1,
          'vip_expiry_date' => now()->addYear(),
        ]);
      }

      // 6. Return kendaraan (GraphQL akan resolve relasi vipInfo dan barcode otomatis)
      return $vehicle;
    });
  }
}
