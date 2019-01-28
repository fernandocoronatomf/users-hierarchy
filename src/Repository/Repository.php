<?php

declare(strict_types=1);

namespace UserHierarchy\Repository;

abstract class Repository
{
    /** @var RepositoryInterface $repository */
    protected $collection;

    public function getAll()
    {
        return $this->collection->all();
    }

    public function remove()
    {
        // TODO: Implement remove() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    /**
     * @param array $item
     * @return bool
     */
    public function save(array $item): bool
    {
        $this->collection->offsetSet($item['Id'], $item);
        return true;
    }

    /**
     * @param array $items
     * @return bool
     */
    public function saveAll(array $items)
    {
        foreach ($items as $item) {
            $this->save($item);
        }
        return true;
    }
}