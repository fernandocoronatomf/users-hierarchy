# Overview

This library provides an api to insert roles and users in a hierarchical way

and making it possible to retrieve a user's subordinate users based on their roles

```php

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

// Add Roles
$roleRepository = new RoleRepository(new RoleCollection);
$roleRepository->saveAll($roles);

// Add Users
$userRepository = new UserRepository(new UserCollection);
$userRepository->saveAll($users);

# Using adaptor 1:

$tree = new RecursiveTreeAdaptor($roleRepository->getAll());
$subordinates = $userRepository->getSubOrdinates($tree, 1);

# Using adaptor 2
$tree = new LoopingThroughTreeAdaptor($roleRepository->getAll());
$subordinates = $userRepository->getSubOrdinates($tree, 1);




```