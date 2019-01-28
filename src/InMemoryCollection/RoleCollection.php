<?php

declare(strict_types=1);

namespace UserHierarchy\InMemoryCollection;

use ArrayAccess;

class RoleCollection extends Collection implements ArrayAccess
{
    /** This is used to generate messages accordingly to type of collection */
    protected $entityName = 'Role';
}