<?php

namespace App\GraphQL\Queries;

use App\Models\Laundry;

class GetLaundry
{
    public function __invoke($_, array $args)
    {
        return Laundry::all();
    }
}
