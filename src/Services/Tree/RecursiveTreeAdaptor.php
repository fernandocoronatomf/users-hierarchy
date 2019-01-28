<?php

declare(strict_types=1);

namespace UserHierarchy\Services\Tree;

use RecursiveArrayIterator;
use RecursiveIteratorIterator;
use UserHierarchy\Repository\RoleRepository;
use UserHierarchy\Repository\UserRepository;

class RecursiveTreeAdaptor implements AdaptorInterface
{
    /**
     * @var RoleRepository $roleRepository
     */
    private $roleRepository;

    /**
     * @var UserRepository $userRepository
     */
    private $userRepository;

    /**
     * RecursiveAdaptor constructor.
     * @param RoleRepository $roleRepository
     * @param UserRepository $userRepository
     */
    public function __construct(RoleRepository $roleRepository, UserRepository $userRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @param int $parentId
     * @return array
     */
    public function buildTree(int $parentId)
    {
        $roles = $this->roleRepository->getAll();

        $tree = [];

        array_walk($roles, function ($role) use ($parentId, &$tree) {
            if ($role['Parent'] === $parentId) {
                $role['children'] = $this->buildTree($role['Id']);
                $tree[] = $role;
                unset($role);
            }
        });

        return $tree;
    }

    public function getSubOrdinates(int $roleId): array
    {
        $tree = $this->buildTree($roleId);

        $roles = $this->getRoleIds($tree);

        $users = $this->userRepository->getAll();

        $filteredUsers = array_filter($users, function ($user) use ($roles) {
            return in_array($user['Role'], $roles);
        });

        return $filteredUsers;
    }

    private function getRoleIds($tree)
    {
        return $this->recursiveFindByKey($tree, 'Id');
    }

    private function recursiveFindByKey(array $array, $needle)
    {
        $iterator = new RecursiveArrayIterator($array);
        $recursive = new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::SELF_FIRST);

        $list = [];

        foreach ($recursive as $key => $value) {
            if ($key !== $needle) {
                continue;
            }
            array_push($list, $value);
        }
        return $list;
    }
}