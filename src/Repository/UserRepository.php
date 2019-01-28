<?php

declare(strict_types=1);

namespace UserHierarchy\Repository;

use UserHierarchy\InMemoryCollection\UserCollection;
use UserHierarchy\Services\Tree\AdaptorInterface;

class UserRepository implements RepositoryInterface, UserHierarchyInterface
{
    /** @var UserCollection $user */
    private $user;

    public function __construct(UserCollection $user)
    {
        $this->user = $user;
    }

    public function getAll()
    {
        return $this->user->all();
    }

    public function remove()
    {
        // TODO: Implement remove() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function save(array $item): bool
    {
        $this->user->offsetSet($item['Id'], $item);
        return true;
    }

    /**
     * @param AdaptorInterface $adaptor
     * @param array $user
     * @return array
     */
    public function getSubOrdinates(AdaptorInterface $adaptor, array $user): array
    {
        return $adaptor->getSubOrdinates($user['Role']);
    }
}