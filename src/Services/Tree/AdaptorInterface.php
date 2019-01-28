<?php

declare(strict_types=1);

namespace UserHierarchy\Services\Tree;

interface AdaptorInterface
{
    public function getSubOrdinates(int $roleId): array;

    public function buildTree(int $parentId);
}