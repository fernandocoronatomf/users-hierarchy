<?php

declare(strict_types=1);

namespace UserHierarchy\Repository;

use UserHierarchy\InMemoryCollection\RoleCollection;

class RoleRepository implements RepositoryInterface
{
    /** @var RoleCollection $role */
    private $role;

    public function __construct(RoleCollection $role)
    {
        $this->role = $role;
    }

    public function getAll(): array
    {
        return $this->role->all();
    }

    public function save(array $item): bool
    {
        $this->role->offsetSet($item['Id'], $item);
        return true;
    }

    public function remove()
    {
        // TODO: Implement remove() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }
}