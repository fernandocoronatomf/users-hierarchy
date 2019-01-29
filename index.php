<?php

require __DIR__ . '/vendor/autoload.php';

use UserHierarchy\InMemoryCollection\RoleCollection;
use UserHierarchy\InMemoryCollection\UserCollection;
use UserHierarchy\Repository\RoleRepository;
use UserHierarchy\Repository\UserRepository;
use UserHierarchy\Services\Tree\RecursiveTreeAdaptor;

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

$tree = new RecursiveTreeAdaptor($roleRepository->getAll());
$subordinates = $userRepository->getSubOrdinates($tree, 1);
var_dump(count($subordinates) === 4);

$tree = new RecursiveTreeAdaptor($roleRepository->getAll());
$subordinates = $userRepository->getSubOrdinates($tree, 2);
var_dump(count($subordinates) === 0);

$tree = new RecursiveTreeAdaptor($roleRepository->getAll());
$subordinates = $userRepository->getSubOrdinates($tree, 3);
var_dump(count($subordinates) === 2);

$tree = new RecursiveTreeAdaptor($roleRepository->getAll());
$subordinates = $userRepository->getSubOrdinates($tree, 4);
var_dump(count($subordinates) === 3);

$tree = new RecursiveTreeAdaptor($roleRepository->getAll());
$subordinates = $userRepository->getSubOrdinates($tree, 5);
var_dump(count($subordinates) === 0);