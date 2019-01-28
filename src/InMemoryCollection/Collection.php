<?php

namespace UserHierarchy\InMemoryCollection;

use InvalidArgumentException;

abstract class Collection
{
    private $items = [];

    public function all()
    {
        return $this->items;
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        if (in_array($offset, array_keys($this->items))) {
            return true;
        }

        return false;
    }

    /**
     * @param mixed $offset
     * @return array
     * @throws EntityNotFoundException
     */
    public function offsetGet($offset): array
    {
        if (!$this->offsetExists($offset)) {
            throw new EntityNotFoundException("{$this->entityName} not found");
        }

        return $this->items[$offset];
    }

    public function offsetSet($offset, $value)
    {
        if (!$offset) {
            throw new InvalidArgumentException('Offset is expected');
        }

        $this->items[$offset] = $value;
    }

    /**
     * @param mixed $offset
     * @throws EntityNotFoundException
     */
    public function offsetUnset($offset)
    {
        if (!$offset) {
            throw new InvalidArgumentException('Offset is expected');
        }

        if (!$this->offsetExists($offset)) {
            throw new EntityNotFoundException("{$this->entityName} not found");
        }

        unset($this->items[$offset]);
    }
}