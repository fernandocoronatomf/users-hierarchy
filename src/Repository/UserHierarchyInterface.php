<?php

declare(strict_types=1);

namespace UserHierarchy\Repository;

use UserHierarchy\Decorator\ArrayDecorator;
use UserHierarchy\Services\Tree\AdaptorInterface;

interface UserHierarchyInterface
{
    public function getSubOrdinates(AdaptorInterface $adaptor, int $userId): ArrayDecorator;
}