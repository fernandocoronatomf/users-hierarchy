<?php

declare(strict_types=1);

namespace UserHierarchy\Repository;

use UserHierarchy\Decorator\ArrayDecorator;
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
     * @return ArrayDecorator
     */
    public function getSubOrdinates(AdaptorInterface $adaptor, int $userId): ArrayDecorator
    {
        $userRoleId = $this->get($userId)['Role'];

        $subordinateRoleIds = $adaptor
            ->buildTree($userRoleId)
            ->getAllDescendantsIds();

        $subordinateUsers = array_filter($this->getAll(), function ($user) use ($subordinateRoleIds) {
            return in_array($user['Role'], $subordinateRoleIds);
        });

        return new ArrayDecorator($subordinateUsers);
    }
}