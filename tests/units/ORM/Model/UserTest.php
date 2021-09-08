<?php

namespace tests\units\ORM\Selector;

use PHPUnit\Framework\TestCase;
use tests\mock\User;
use tests\mock\UserMapper;

/**
 * class UserTest
 *
 * @package tests\units\ORM\Selector
 * @covers \Norm\ORM\Model\Model
 * @covers \Norm\ORM\Mapper\BaseMapper
 * @covers \tests\mock\User
 * @covers \tests\mock\UserMapper
 */
class UserTest extends TestCase
{
    public function testGetMapper()
    {
        $tester = new User();
        $this->assertNull($tester->getMapper());

        $mapper = new UserMapper();
        $tester = new User([], $mapper);
        $this->assertInstanceOf(UserMapper::class, $tester->getMapper());
    }
}
