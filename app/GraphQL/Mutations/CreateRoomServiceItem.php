<?php

namespace App\GraphQL\Mutations;

use App\Models\RoomServiceItem;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CreateRoomServiceItem extends Mutation
{
    protected $attributes = [
        'name' => 'createRoomServiceItem',
    ];

    public function type(): Type
    {
        return GraphQL::type('RoomServiceItem');
    }

    public function args(): array
    {
        return [
            'room_type' => [
                'type' => Type::nonNull(Type::string()),
            ],
            'add_on' => [
                'type' => Type::nonNull(Type::string()),
            ],
            'price' => [
                'type' => Type::nonNull(Type::float()),
            ],
        ];
    }

    public function resolve($root, $args)
    {
        return RoomServiceItem::create([
            'room_type' => $args['room_type'],
            'add_on' => $args['add_on'],
            'price' => $args['price'],
        ]);
    }
}
