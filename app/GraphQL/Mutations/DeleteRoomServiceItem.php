<?php

namespace App\GraphQL\Mutations;

use App\Models\RoomServiceItem;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class DeleteRoomServiceItem extends Mutation
{
    protected $attributes = [
        'name' => 'deleteRoomServiceItem',
    ];

    public function type(): Type
    {
        return Type::boolean(); // true/false response
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::nonNull(Type::int())],
        ];
    }

    public function resolve($root, $args)
    {
        $item = RoomServiceItem::findOrFail($args['id']);
        return $item->delete();
    }
}
