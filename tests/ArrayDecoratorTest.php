<?php

use PHPUnit\Framework\TestCase;
use UserHierarchy\Decorator\ArrayDecorator;

class ArrayDecoratorTest extends TestCase
{
    /** @test */
    public function it_returns_json_output()
    {
        $test = [1, 2, 3];

        $decorator = new ArrayDecorator($test);

        $this->assertEquals(
            count($test),
            $decorator->count()
        );

        $this->assertJson(
            $decorator->toJson()
        );

    }
}