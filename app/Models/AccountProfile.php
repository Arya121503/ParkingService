<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountProfile extends Model
{
    protected $fillable = [
        'account_id',
        'full_name',
        'birth_date',
        'profile_image',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
