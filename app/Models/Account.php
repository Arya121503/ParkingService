<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Account extends Authenticatable
{
    protected $fillable = [
        'username',
        'email',
        'password',
        'phone_number',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->password = Hash::make($model->password);
        });

        static::updating(function ($model) {
            if ($model->isDirty('password')) {
                $model->password = Hash::make($model->password);
            }
        });
    }

    public function profile()
    {
        return $this->hasOne(AccountProfile::class);
    }

    public function logs()
    {
        return $this->hasMany(AccountLog::class);
    }

    public function vipMembership()
    {
        return $this->hasOne(VipMembership::class);
    }
}
