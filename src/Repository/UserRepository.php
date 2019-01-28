<?php

declare(strict_types=1);

namespace UserHierarchy\Repository;

use UserHierarchy\InMemoryCollection\UserCollection;
use UserHierarchy\Services\Tree\AdaptorInterface;

class UserRepository extends Repository implements RepositoryInterface, UserHierarchyInterface
{
    protected $collection;

    /**
     * UserRepository constructor.
     * @param UserCollection $collection
     */
    public function __construct(UserCollection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * @param AdaptorInterface $adaptor
     * @param int $userId
     * @return array
     */
    public function getSubOrdinates(AdaptorInterface $adaptor, int $userId): array
    {
        $adaptor->buildTree(
            $this->get($userId)['Role']
        );

        $subordinateRoles = $adaptor->getTreeIds();

        return array_filter($this->getAll(), function ($user) use ($subordinateRoles) {
            return in_array($user['Role'], $subordinateRoles);
        });
    }
}