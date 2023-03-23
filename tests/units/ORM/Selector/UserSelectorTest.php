<?php

namespace tests\units\ORM\Selector;

use Norm\DB\DQuery;
use Norm\DB\IStorage;
use Norm\ORM\Mapper\Mapper;
use Norm\ORM\Selector\Selector;
use PHPUnit\Framework\TestCase;
use tests\mock\user\User;
use tests\mock\user\UserMapper;
use tests\mock\user\UserSelector;

/**
 * class UserSelectorTest
 *
 * @package tests\units\ORM\Selector
 * @covers \Norm\DB\DQuery
 * @covers \Norm\DB\DWhere
 * @covers \Norm\ORM\Model\Model
 * @covers \Norm\ORM\Mapper\BaseMapper
 * @covers \Norm\ORM\Selector\Selector
 * @covers \tests\mock\user\User
 * @covers \tests\mock\user\UserMapper
 * @covers \tests\mock\user\UserSelector
 */
class UserSelectorTest extends TestCase
{
    private IStorage $db;
    private Selector $selector;

    public function setUp(): void
    {
        parent::setUp();
        $mockData = ['id' => 1, 'nick' => 'test-user-nick'];
        $this->db = $this->createStub(IStorage::class);
        $this->db->method('setCondition')->willReturn($this->db);
        $this->db->method('findData')->willReturn($mockData);
        $this->selector = new UserSelector($this->db);
    }

    public function testGetUser()
    {
        $tester = $this->selector;
        $user = $tester->getUser(1);
        $this->assertInstanceOf(User::class, $user);
        $this->assertSame(1, $user->getId());
        $this->assertSame('test-user-nick', $user->getNick());
        $this->assertSame(['id' => 1, 'nick' => 'test-user-nick'], $user->render());

        $user->setNick('new-nick');
        $this->assertSame(['id' => 1, 'nick' => 'new-nick'], $tester->getMapper()->prepareSaveData($user));
    }

    public function testSelectorGetDB()
    {
        $this->assertInstanceOf(IStorage::class, $this->selector->getDb());
    }

    public function testSelectorCreateModel()
    {
        $this->assertInstanceOf(User::class, $this->selector->createModel());
    }

    public function testSelectorInsertAll()
    {
        $mockMapper = $this->createStub(UserMapper::class);
        $mockMapper->method('insertAll')->willReturn(2);
        $tester = new UserSelector($this->db, $mockMapper);
        $this->assertSame(2, $tester->insertAll([['nickname' => 'new-user-2'], ['nick' => 'new-user-3']]));
    }

    public function testSelectorTrans()
    {
        $mockMapper = $this->createStub(UserMapper::class);
        $mockMapper->method('startTrans')->willReturn(true);
        $mockMapper->method('commit')->willReturn(true);
        $mockMapper->method('rollback')->willReturn(true);

        $tester = new UserSelector($this->db, $mockMapper);
        $this->assertTrue($tester->startTrans());
        $this->assertTrue($tester->commit());
        $this->assertTrue($tester->rollback());
    }

    public function testSelectorMapperSelectObjs()
    {
        $mapper = $this->createStub(Mapper::class);
        $mapper->method('selectObjs')->willReturn([]);
        $this->assertSame([], $this->selector->mapperSelectObjs($mapper, new DQuery()));
    }

    public function testSelectorMapperFindObjWhere()
    {
        $mapper = $this->createStub(Mapper::class);
        $mapper->method('findObjWhere')->willReturn((new User())->setId(42)->setNick('Mostly Harmless'));
        $model = $this->selector->mapperFindObjWhere($mapper, new DQuery());
        $this->assertInstanceOf(User::class, $model);
        $this->assertSame(42, $model->getId());
        $this->assertSame('Mostly Harmless', $model->getNick());
    }

    public function testSelectorMapperFindObj()
    {
        $mapper = $this->createStub(Mapper::class);
        $mapper->method('findObj')->willReturn((new User())->setId(42)->setNick('Mostly Harmless'));
        $model = $this->selector->mapperFindObj($mapper, 42);
        $this->assertInstanceOf(User::class, $model);
        $this->assertSame(42, $model->getId());
        $this->assertSame('Mostly Harmless', $model->getNick());
    }
}
