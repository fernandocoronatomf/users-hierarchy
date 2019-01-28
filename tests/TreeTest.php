<?php

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use UserHierarchy\InMemoryCollection\RoleCollection;
use UserHierarchy\InMemoryCollection\UserCollection;
use UserHierarchy\Repository\RoleRepository;
use UserHierarchy\Repository\UserRepository;
use UserHierarchy\Services\Tree\RecursiveTreeAdaptor;

class TreeTest extends TestCase
{
    /** @var RoleRepository $repository */
    private $roleRepository;

    /** @var UserRepository $userRepo*/
    private $userRepo;

    public function setUp(): void
    {
        parent::setUp();
        $roles = [
            [
                'Id' => 1,
                'Name' => 'System Administrator',
                'Parent' => 0
            ],
            [
                'Id' => 2,
                'Name' => 'Location Manager',
                'Parent' => 1,
            ],
            [
                'Id' => 3,
                'Name' => 'Supervisor',
                'Parent' => 2,
            ],
            [
                'Id' => 4,
                'Name' => 'Employee',
                'Parent' => 3,
            ],
            [
                'Id' => 5,
                'Name' => 'Trainer',
                'Parent' => 3,
            ]
        ];

        $this->roleRepository = new RoleRepository(new RoleCollection);
        foreach ($roles as $role) {
            $this->roleRepository->save($role);
        }

        $users = [
            [
                'Id' => 1,
                'Name' => 'Adam Admin',
                'Role' => 1
            ],
            [
                'Id' => 2,
                'Name' => 'Emily Employee',
                'Role' => 4
            ],
            [
                'Id' => 3,
                'Name' => 'Sam Supervisor',
                'Role' => 3
            ],
            [
                'Id' => 4,
                'Name' => 'Mary Manager',
                'Role' => 2,
            ],
            [
                'Id' => 5,
                'Name' => 'Steve Trainer',
                'Role' => 5
            ]
        ];

        $this->userRepo = new UserRepository(new UserCollection);
        foreach ($users as $user) {
            $this->userRepo->save($user);
        }
    }

    /** @test */
    public function it_should_return_2_children_roles()
    {
        $adaptor = new RecursiveTreeAdaptor($this->roleRepository, $this->userRepo);

        $users = $this->userRepo->getAll();

        $childrenRoles = $this->userRepo->getSubOrdinates($adaptor, $users[3]);

        $this->assertCount(
            2,
            $childrenRoles
        );
    }

    /** @test */
    public function it_should_return_4_subordinate_users()
    {
        $adaptor = new RecursiveTreeAdaptor($this->roleRepository, $this->userRepo);

        $users = $this->userRepo->getAll();

        $users = $this->userRepo->getSubOrdinates($adaptor, $users[1]);

        $this->assertCount(
            4,
            $users
        );
    }
}
