<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomServiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_type',
        'add_on',
        'price',
    ];
}
