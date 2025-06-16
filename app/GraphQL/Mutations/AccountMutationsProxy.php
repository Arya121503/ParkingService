<?php

namespace App\GraphQL\Mutations;

use App\Models\Account;
use App\Models\VipMembership;
use App\Models\AccountProfile;
use App\Models\AccountLog;
use Illuminate\Support\Facades\Hash;

class AccountMutationsProxy
{
    // ============================
    // CREATE
    // ============================

    public function createAccount($_, array $args): Account
    {
        $input = $args['input'];

        return Account::create([
            'username' => $input['username'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'phone_number' => $input['phone_number'] ?? null,
        ]);
    }

    public function createAccountProfile($_, array $args): AccountProfile
    {
        $input = $args['input'];

        return AccountProfile::create([
            'account_id' => $input['account_id'],
            'full_name' => $input['full_name'],
            'birth_date' => $input['birth_date'] ?? null,
            'profile_image' => $input['profile_image'] ?? null,
        ]);
    }

    public function createAccountLog($_, array $args): AccountLog
    {
        $input = $args['input'];

        return AccountLog::create([
            'account_id' => $input['account_id'],
            'action' => $input['action'],
            'description' => $input['description'],
        ]);
    }

    // ============================
    // UPDATE
    // ============================

    public function updateVipMembership($_, array $args): VipMembership
    {
        $input = $args['input'];

        return VipMembership::updateOrCreate(
            ['account_id' => $input['account_id']],
            [
                'level' => $input['level'],
                'expires_at' => $input['expires_at'] ?? null,
            ]
        );
    }

    public function updateAccountProfile($_, array $args): AccountProfile
    {
        $input = $args['input'];

        $profile = AccountProfile::where('account_id', $input['account_id'])->firstOrFail();

        $profile->update([
            'full_name' => $input['full_name'] ?? $profile->full_name,
            'birth_date' => $input['birth_date'] ?? $profile->birth_date,
            'profile_image' => $input['profile_image'] ?? $profile->profile_image,
        ]);

        return $profile;
    }

    public function updateAccountLog($_, array $args): AccountLog
    {
        $input = $args['input'];

        $log = AccountLog::findOrFail($input['id']);

        $log->update([
            'action' => $input['action'] ?? $log->action,
            'description' => $input['description'] ?? $log->description,
        ]);

        return $log;
    }

    // ============================
    // DELETE
    // ============================

    public function deleteAccount($_, array $args): bool
    {
        return Account::findOrFail($args['id'])->delete();
    }

    public function deleteVipMembership($_, array $args): bool
    {
        return VipMembership::where('account_id', $args['account_id'])->delete() > 0;
    }

    public function deleteAccountProfile($_, array $args): bool
    {
        return AccountProfile::where('account_id', $args['account_id'])->delete() > 0;
    }

    public function deleteAccountLog($_, array $args): bool
    {
        return AccountLog::findOrFail($args['id'])->delete();
    }
}
