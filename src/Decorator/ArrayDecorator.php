<?php

declare(strict_types=1);

namespace UserHierarchy\Decorator;

use JsonSerializable;

class ArrayDecorator implements JsonSerializable
{
    private $collection;

    /**
     * UserListDecorator constructor.
     * @param array $collection
     */
    public function __construct(array $collection)
    {
        $this->collection = $collection;
    }

    public function jsonSerialize()
    {
        return array_values($this->collection);
    }

    public function toJson()
    {
        return json_encode($this);
    }

    public function count(): int
    {
        return count($this->collection);
    }

    public function toArray()
    {
        return $this->collection;
    }
}
