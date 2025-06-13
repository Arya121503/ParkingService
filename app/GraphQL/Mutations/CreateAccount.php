<?php

namespace App\GraphQL\Mutations;

use App\Models\Account;
use Illuminate\Support\Facades\Hash;

class CreateAccount
{
    public function __invoke($_, array $args): Account
    {
        return Account::create([
            'username' => $args['username'],
            'email' => $args['email'],
            'password' => Hash::make($args['password']),
            'phone_number' => $args['phone_number'] ?? null,
        ]);
    }
}
