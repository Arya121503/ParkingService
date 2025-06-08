<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle;
use App\Models\VipVehicle;
use App\Models\ParkingRecord;
use App\Models\ParkingRate;
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class ParkingSeeder extends Seeder
{
    public function run(): void
    {
        // Parking rates
        ParkingRate::create(['type' => 'motor', 'vip_only' => false, 'daily_rate' => 5000]);
        ParkingRate::create(['type' => 'mobil', 'vip_only' => false, 'daily_rate' => 10000]);
        ParkingRate::create(['type' => 'mobil', 'vip_only' => true, 'daily_rate' => 25000]);

        // Vehicles
        $vehicle1 = Vehicle::create([
            'license_plate' => 'B1234XYZ',
            'type' => 'mobil',
            'owner_name' => 'Asep'
        ]);

        $vehicle2 = Vehicle::create([
            'license_plate' => 'D5678MTR',
            'type' => 'motor',
            'owner_name' => 'Budi'
        ]);

        // Generate barcode
        $vehicle1->barcode = 'BR-' . strtoupper($vehicle1->license_plate) . '-' . Str::random(6);
        $vehicle1->save();

        $vehicle2->barcode = 'BR-' . strtoupper($vehicle2->license_plate) . '-' . Str::random(6);
        $vehicle2->save();

        // VIP Info
        VipVehicle::create([
            'vehicle_id' => $vehicle1->id,
            'vip_level' => 1,
            'vip_expiry_date' => now()->addMonths(6)
        ]);

        // Parking Record
        $record = ParkingRecord::create([
            'vehicle_id' => $vehicle1->id,
            'entry_time' => Carbon::now()->subHours(3),
            'exit_time' => Carbon::now(),
            'parking_spot' => 'A12'
        ]);

        // Payment
        Payment::create([
            'parking_record_id' => $record->id,
            'amount_paid' => 25000,
            'paid_at' => Carbon::now(),
            'payment_method' => 'cash'
        ]);
    }
}
