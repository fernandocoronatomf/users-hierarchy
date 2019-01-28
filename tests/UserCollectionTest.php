<?php

namespace Tests;

use http\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use UserHierarchy\InMemoryCollection\EntityNotFoundException;
use UserHierarchy\InMemoryCollection\UserCollection;

class UserCollectionTest extends TestCase
{
    /** @test */
    public function it_returns_all_users_in_the_collection()
    {
        $userCollection = new UserCollection;

        if (!$userCollection->offsetExists(1)) {
            $userCollection[1] = [
                'Id' => 1,
                'Name' => 'Fernando',
                'Role' => 0,
            ];
        }

        if (!$userCollection->offsetExists(2)) {
            $userCollection[2] = [
                'Id' => 2,
                'Name' => 'Adam',
                'Role' => 1,
            ];
        }

        $this->assertCount(
            2,
            $userCollection->all()
        );
    }

    /** @test */
    public function it_returns_user_by_index()
    {
        $userCollection = new UserCollection;

        if (!$userCollection->offsetExists(1)) {
            $userCollection[1] = [
                'Id' => 1,
                'Name' => 'Fernando',
                'Role' => 0,
            ];
        }

        if (!$userCollection->offsetExists(2)) {
            $userCollection[2] = [
                'Id' => 2,
                'Name' => 'Adam',
                'Role' => 1,
            ];
        }

        $this->assertEquals(
            [
                'Id' => 1,
                'Name' => 'Fernando',
                'Role' => 0,
            ],
            $userCollection->offsetGet(1)
        );
    }

    /** @test */
    public function it_fails_to_find_user_with_wrong_index()
    {
        $userCollection = new UserCollection;

        if (!$userCollection->offsetExists(1)) {
            $userCollection[1] = [
                'Id' => 1,
                'Name' => 'Fernando',
                'Role' => 0,
            ];
        }

        $this->expectException(EntityNotFoundException::class);
        $userCollection->offsetGet(10);
    }

    /** @test */
    public function it_removes_user_from_collection()
    {
        $userCollection = new UserCollection;

        if (!$userCollection->offsetExists(1)) {
            $userCollection[1] = [
                'Id' => 1,
                'Name' => 'Fernando',
                'Role' => 0,
            ];
        }

        unset($userCollection[1]);
        $this->assertCount(
            0,
            $userCollection->all()
        );
    }

    /** @test */
    public function it_fails_to_remove_user_that_does_not_exist()
    {
        $userCollection = new UserCollection;
        $this->expectException(EntityNotFoundException::class);
        unset($userCollection[1]);
    }

    /** @test */
    public function it_fails_to_add_user_with_no_index()
    {
        $userCollection = new UserCollection;
        $this->expectException(\InvalidArgumentException::class);
        $userCollection[] = [];
    }

    /** @test */
    public function it_fails_to_remove_user_if_no_index_is_passed()
    {
        $userCollection = new UserCollection;

        $this->expectException(\InvalidArgumentException::class);
        unset($userCollection[null]);
    }

    /** @test */
    public function it_fails_to_get_user_with_no_index()
    {
        $userCollection = new UserCollection;

        $this->expectException(EntityNotFoundException::class);
        $userCollection->offsetGet(null);
    }
}