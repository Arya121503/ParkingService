<?php

namespace App\GraphQL\Queries;

use App\Models\Account;

class AccountQuery
{
    public function find($_, array $args): ?Account
    {
        return Account::with(['profile', 'logs', 'vipMembership'])->find($args['id']);
    }

    public function byVipLevel($_, array $args)
    {
        return Account::whereHas('vipMembership', function ($q) use ($args) {
            $q->where('level', $args['level']);
        })->get();
    }
}
