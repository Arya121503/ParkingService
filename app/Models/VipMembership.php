<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VipMembership extends Model
{
    protected $fillable = [
        'account_id',
        'level',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'date',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
