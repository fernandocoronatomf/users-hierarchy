<?php

require __DIR__ . '/vendor/autoload.php';

use UserHierarchy\InMemoryCollection\RoleCollection;
use UserHierarchy\InMemoryCollection\UserCollection;
use UserHierarchy\Repository\RoleRepository;
use UserHierarchy\Repository\UserRepository;
use UserHierarchy\Services\Tree\ExternalPackageAdaptor;
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
echo 'Adam Admin`s subordinates: <br>';
echo $subordinates->toJson();
echo "<br><br>";

$tree = new RecursiveTreeAdaptor($roleRepository->getAll());
$subordinates = $userRepository->getSubOrdinates($tree, 2);
echo 'Emily Employee`s subordinates: <br />';
echo $subordinates->toJson();
echo "<br><br>";

$tree = new RecursiveTreeAdaptor($roleRepository->getAll());
$subordinates = $userRepository->getSubOrdinates($tree, 3);
echo 'Sam Supervisor`s subordinates: <br />';
echo $subordinates->toJson();
echo "<br><br>";

$tree = new ExternalPackageAdaptor($roleRepository->getAll());
$subordinates = $userRepository->getSubOrdinates($tree, 4);
echo 'Mary Manager`s subordinates: <br />';
echo $subordinates->toJson();
echo "<br><br>";

$tree = new ExternalPackageAdaptor($roleRepository->getAll());
$subordinates = $userRepository->getSubOrdinates($tree, 5);
echo 'Steve Trainees`s subordinates: <br />';
echo $subordinates->toJson();
echo "<br><br>";