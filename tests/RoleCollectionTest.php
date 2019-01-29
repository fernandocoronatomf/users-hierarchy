<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use UserHierarchy\InMemoryCollection\RoleCollection;
use UserHierarchy\Repository\RoleRepository;

class RoleCollectionTest extends TestCase
{
    /** @test */
    public function it_adds_new_roles_to_role_model()
    {
        $newRole = [
            'Id' => 1,
            'Name' => 'System Administrator',
            'Parent' => 0
        ];

        $role = new RoleRepository(new RoleCollection);
        $role->save($newRole);

        $this->assertCount(
            1,
            $role->getAll($newRole)
        );


        $newRole = [
            'Id' => 2,
            'Name' => 'System Helper',
            'Parent' => 1
        ];

        $role->save($newRole);

        $this->assertCount(
            2,
            $role->getAll($newRole)
        );
    }
}
