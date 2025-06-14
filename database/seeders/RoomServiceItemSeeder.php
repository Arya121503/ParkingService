<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoomServiceItem;

class RoomServiceItemSeeder extends Seeder
{
    public function run(): void
    {
        RoomServiceItem::insert([
            [
                'room_type' => 'Stadard',
                'add_on' => 'Laundry Express',
                'price' => 400000,
            ],
            [
                'room_type' => 'VIP',
                'add_on' => 'Extra Bad',
                'price' => 800000,
            ],
            [
                'room_type' => 'VIP',
                'add_on' => 'Evening Room Cleaning',
                'price' => 1000000,
            ],
        ]);
    }
}
