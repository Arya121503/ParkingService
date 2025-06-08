<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'parking_record_id',
        'amount_paid',
        'paid_at',
        'payment_method',
    ];

    public function parkingRecord(): BelongsTo
    {
        return $this->belongsTo(ParkingRecord::class);
    }
}

