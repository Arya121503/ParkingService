<?php

namespace App\GraphQL\Resolvers;

use App\Models\Account;

class AccountResolver
{
    public function findAccount($_, array $args): ?Account
    {
        return Account::with(['profile', 'logs', 'vipMembership'])->find($args['id']);
    }

    public function accountsByVipLevel($_, array $args)
    {
        return Account::whereHas('vipMembership', function ($query) use ($args) {
            $query->where('level', $args['level']);
        })->get();
    }
}
