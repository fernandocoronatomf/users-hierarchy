<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Tests\Traits\SeedsData;
use UserHierarchy\Repository\RoleRepository;
use UserHierarchy\Repository\UserRepository;
use UserHierarchy\Services\Tree\AdaptorInterface;

class ExternalPackageAdaptorTest extends TestCase
{
    use SeedsData;

    /** @var RoleRepository $repository */
    private $roleRepository;

    /** @var UserRepository $userRepo*/
    private $userRepo;

    /** @var AdaptorInterface $adaptor */
    private $adaptor;

    /** Name of the adaptor to be used */
    private $adaptorName = 'UserHierarchy\Services\Tree\ExternalPackageAdaptor';

    /** @test */
    public function it_should_return_4_subordinate_users_for_user_no_1()
    {
        $users = $this->userRepo->getSubOrdinates($this->adaptor, 1);

        $this->assertCount(
            4,
            $users
        );
    }

    /** @test */
    public function it_should_return_4_subordinate_users_for_user_no_2()
    {
        $users = $this->userRepo->getSubOrdinates($this->adaptor, 2);

        $this->assertEmpty(
            $users
        );
    }

    /** @test */
    public function it_should_return_2_subordinate_users_for_user_no_3()
    {
        $childrenRoles = $this->userRepo->getSubOrdinates($this->adaptor, 3);

        $this->assertCount(
            2,
            $childrenRoles
        );
    }

    /** @test */
    public function it_should_return_3_subordinate_users_for_user_no_4()
    {
        $users = $this->userRepo->getSubOrdinates($this->adaptor, 4);

        $this->assertCount(
            3,
            $users
        );
    }

    /** @test */
    public function it_should_return_3_subordinate_users_for_user_no_5()
    {
        $users = $this->userRepo->getSubOrdinates($this->adaptor, 5);

        $this->assertEmpty(
            $users
        );
    }
}
