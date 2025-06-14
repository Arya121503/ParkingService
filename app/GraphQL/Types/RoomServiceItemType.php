<?php

namespace App\GraphQL\Types;

use App\Models\RoomServiceItem;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class RoomServiceItemType extends GraphQLType
{
    protected $attributes = [
        'name' => 'RoomServiceItem',
        'description' => 'Tipe data untuk item layanan kamar',
        'model' => RoomServiceItem::class,
    ];

    public function fields(): array
{
    return [
        'id' => [
            'type' => Type::nonNull(Type::int()),
        ],
        'room_type' => [
            'type' => Type::string(),
        ],
        'add_on' => [
            'type' => Type::string(),
        ],
        'price' => [
            'type' => Type::float(),
        ],
    ];
}

}
