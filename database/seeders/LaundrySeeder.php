<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Laundry;

class LaundrySeeder extends Seeder
{
    public function run(): void
    {
        Laundry::insert([
            [
                'customer_name' => 'Andi',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_name' => 'Siti',
                'status' => 'in_progress',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_name' => 'Rina',
                'status' => 'done',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
