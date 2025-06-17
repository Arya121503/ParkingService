<?php

namespace App\GraphQL\Mutations;

use App\Models\Laundry;

class UpdateLaundryStatus
{
    public function __invoke($_, array $args)
    {
        $laundry = Laundry::findOrFail($args['id']);
        $laundry->status = $args['status'];
        $laundry->save();

        return $laundry;
    }
}
