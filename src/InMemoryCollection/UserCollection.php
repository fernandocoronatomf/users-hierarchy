<?php

declare(strict_types=1);

namespace UserHierarchy\InMemoryCollection;

use ArrayAccess;

class UserCollection extends Collection implements ArrayAccess
{
    /** This is used to generate messages accordingly to type of collection */
    protected $entityName = 'User';
}