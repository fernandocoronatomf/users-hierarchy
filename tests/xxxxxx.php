<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use UserHierarchy\InMemoryCollection\UserCollection;
use UserHierarchy\Repository\UserRepository;

class xxxxxx extends TestCase
{
    /** @test */
    public function it_adds_new_users_to_user_model()
    {
        $newUser = [
            'Id' => 1,
            'Name' => 'Adam Admin',
            'Role' => 1
        ];

        $user = new UserRepository(new UserCollection);
        $user->save($newUser);

        $this->assertCount(
            1,
            $user->getAll()
        );


        $newUser = [
            'Id' => 2,
            'Name' => 'System Helper',
            'Parent' => 1
        ];
        $user->save($newUser);

        $this->assertCount(
            2,
            $user->getAll()
        );
    }
}
