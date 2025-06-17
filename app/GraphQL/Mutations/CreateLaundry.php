<?php

namespace App\GraphQL\Mutations;

use App\Models\Laundry;

class CreateLaundry
{
    public function __invoke($_, array $args)
    {
        return Laundry::create([
            'customer_name' => $args['customer_name'],
            'status' => 'pending', // default value
        ]);
    }
}
