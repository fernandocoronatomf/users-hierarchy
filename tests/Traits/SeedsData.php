<?php

namespace Tests\Traits;

use UserHierarchy\InMemoryCollection\RoleCollection;
use UserHierarchy\InMemoryCollection\UserCollection;
use UserHierarchy\Repository\RoleRepository;
use UserHierarchy\Repository\UserRepository;

trait SeedsData
{
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

        $this->roleRepository = new RoleRepository(new RoleCollection);
        $this->roleRepository->saveAll($roles);

        $this->userRepo = new UserRepository(new UserCollection);
        $this->userRepo->saveAll($users);

        $this->adaptor = new $this->adaptorName($this->roleRepository->getAll());
    }
}