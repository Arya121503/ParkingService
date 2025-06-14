<?php

namespace App\GraphQL\Queries;

use App\Models\RoomServiceItem;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class RoomServiceItemsQuery extends Query
{
    protected $attributes = [
        'name' => 'roomServiceItems',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('RoomServiceItem'));
    }

    public function resolve($root, $args)
    {
        return RoomServiceItem::all();
    }
}
