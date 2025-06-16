<?php

namespace App\GraphQL\Queries;

use App\Models\Account;
use App\Models\AccountProfile;
use App\Models\VipMembership;
use App\Models\AccountLog;

class AccountQueriesProxy
{
    public function account($_, array $args): ?Account
    {
        return Account::find($args['id']);
    }

    public function accounts(): iterable
    {
        return Account::all();
    }

    public function accountProfile($_, array $args): ?AccountProfile
    {
        return AccountProfile::where('account_id', $args['account_id'])->first();
    }

    public function accountProfiles(): iterable
    {
        return AccountProfile::all();
    }

    public function vipMembership($_, array $args): ?VipMembership
    {
        return VipMembership::where('account_id', $args['account_id'])->first();
    }

    public function vipMemberships(): iterable
    {
        return VipMembership::all();
    }

    public function accountLog($_, array $args): ?AccountLog
    {
        return AccountLog::find($args['id']);
    }

    public function accountLogs($_, array $args): iterable
    {
        return isset($args['account_id'])
            ? AccountLog::where('account_id', $args['account_id'])->get()
            : AccountLog::all();
    }
}
