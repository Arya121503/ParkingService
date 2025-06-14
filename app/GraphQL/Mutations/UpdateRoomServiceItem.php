<?php

namespace App\GraphQL\Mutations;

use App\Models\RoomServiceItem;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;

class UpdateRoomServiceItem extends Mutation
{
    protected $attributes = [
        'name' => 'updateRoomServiceItem',
    ];

    public function type(): Type
    {
        return GraphQL::type('RoomServiceItem');
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::nonNull(Type::int())],
            'room_type' => ['type' => Type::string()],
            'add_on' => ['type' => Type::string()],
            'price' => ['type' => Type::float()],
        ];
    }

    public function resolve($root, $args)
    {
        $item = RoomServiceItem::findOrFail($args['id']);
        $item->update($args);
        return $item;
    }
}
