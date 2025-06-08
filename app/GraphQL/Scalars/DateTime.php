<?php

namespace App\GraphQL\Scalars;

use GraphQL\Type\Definition\ScalarType;
use GraphQL\Language\AST\Node;
use GraphQL\Language\AST\StringValueNode;
use Exception;

class DateTime extends ScalarType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'DateTime',
            'description' => 'A datetime string in ISO 8601 format',
        ]);
    }

    public function serialize($value)
    {
        return $value instanceof \DateTimeInterface
            ? $value->format(\DateTime::ATOM)
            : $value;
    }

    public function parseValue($value)
    {
        return new \DateTime($value);
    }

    public function parseLiteral(Node $valueNode, ?array $variables = null)
    {
        if (!$valueNode instanceof StringValueNode) {
            throw new Exception('DateTime must be a string.');
        }

        return new \DateTime($valueNode->value);
    }
}
