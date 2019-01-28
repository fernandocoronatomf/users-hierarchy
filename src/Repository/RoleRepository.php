<?php

declare(strict_types=1);

namespace UserHierarchy\Repository;

use UserHierarchy\InMemoryCollection\RoleCollection;

class RoleRepository extends Repository implements RepositoryInterface
{
    /** @var RoleCollection $role */
    protected $collection;

    public function __construct(RoleCollection $collection)
    {
        $this->collection = $collection;
    }
}