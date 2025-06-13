<?php

namespace App\GraphQL\Mutations;

use App\Models\VipMembership;

class UpdateVipMembership
{
    public function __invoke($_, array $args): VipMembership
    {
        /** @var VipMembership $model */
        $model = VipMembership::updateOrCreate(
            ['account_id' => $args['account_id']],
            [
                'level' => $args['level'],
                'expires_at' => $args['expires_at'] ?? null,
            ]
        );

        return $model;
    }
}
