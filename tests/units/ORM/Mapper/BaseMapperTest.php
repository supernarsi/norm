<?php

namespace tests\units\ORM\Mapper;

use Norm\DB\DQuery;
use Norm\DB\DWhere;
use Norm\DB\IStorage;
use Norm\ORM\Mapper\BaseMapper;
use Norm\ORM\Model\Model;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use tests\mock\Mapper\user\UserMapper;
use tests\mock\Model\user\User;

#[
    CoversClass(BaseMapper::class),
    CoversClass(DQuery::class),
    CoversClass(DWhere::class),
    CoversClass(Model::class),
    UsesClass(UserMapper::class),
]
class BaseMapperTest extends TestCase
{
    private BaseMapper $mapper;

    public function setUp(): void
    {
        parent::setUp();
        $this->mapper = new UserMapper();
    }

    /**
     * @throws Exception
     */
    public function testUpdate()
    {
        $db = $this->createStub(IStorage::class);
        $db->method('updateData')->willReturn(true);
        $this->assertTrue($this->mapper->update($db, ['test' => 1]));
    }

    /**
     * @throws Exception
     */
    public function testInsert()
    {
        $db = $this->createStub(IStorage::class);
        $db->method('insertDataGetId')->willReturn(0);
        $this->assertSame(0, $this->mapper->insert($db, ['test' => 1]));

        $db = $this->createStub(IStorage::class);
        $db->method('insertDataGetId')->willReturn(12);
        $this->assertSame(12, $this->mapper->insert($db, ['test' => 1]));
    }

    /**
     * @throws Exception
     */
    public function testDelete()
    {
        $db = $this->createStub(IStorage::class);
        $db->method('setCondition')->willReturn($db);
        $db->method('deleteData')->willReturn(true);
        $this->assertTrue($this->mapper->delete($db, (new DQuery())->where('id', '=', 13)));
    }

    /**
     * @throws Exception
     */
    public function testCount()
    {
        $db = $this->createStub(IStorage::class);
        $db->method('setCondition')->willReturn($db);
        $db->method('count')->willReturn(20);
        $this->assertSame(20, $this->mapper->count($db, (new DQuery())->where('id', '=', 13)));
    }

    /**
     * @throws Exception
     */
    public function testSum()
    {
        $db = $this->createStub(IStorage::class);
        $db->method('setCondition')->willReturn($db);
        $db->method('sum')->willReturn(41.23);
        $this->assertSame(41.23, $this->mapper->sum($db, (new DQuery())->where('id', '=', 13), 'num'));
    }

    /**
     * @throws Exception
     */
    public function testSelect()
    {
        $db = $this->createStub(IStorage::class);
        $db->method('setCondition')->willReturn($db);
        $db->method('selectData')->willReturn([1, 2, 3]);
        $this->assertSame([1, 2, 3], $this->mapper->select($db, (new DQuery())->where('id', '=', 13)));
    }

    /**
     * @throws Exception
     */
    public function testFindObjWhere()
    {
        $db = $this->createStub(IStorage::class);
        $db->method('setCondition')->willReturn($db);
        $db->method('findData')->willReturn([]);
        $this->assertNull($this->mapper->findObjWhere($db, (new DQuery())->where('id', '=', 1)));

        $db = $this->createStub(IStorage::class);
        $db->method('setCondition')->willReturn($db);
        $db->method('findData')->willReturn(['id' => 42, 'test' => 'hello']);
        $modelMapper = new UserMapper();
        $model = $modelMapper->findObjWhere($db, (new DQuery())->where('id', '=', 2));
        $this->assertInstanceOf(User::class, $model);
        $this->assertSame(42, $model->getId());
        $this->assertSame('', $model->getNick());
    }

    /**
     * @throws Exception
     */
    public function testSelectObjs()
    {
        $db = $this->createStub(IStorage::class);
        $db->method('setCondition')->willReturn($db);
        $db->method('selectData')->willReturn([]);
        $mapper = new UserMapper();
        $this->assertSame([], $mapper->selectObjs($db, (new DQuery())->where('id', '>', 1)));

        $db = $this->createStub(IStorage::class);
        $db->method('setCondition')->willReturn($db);
        $db->method('selectData')->willReturn([['id' => 520, 'nick' => 'lu'], ['id' => 120, 'nick' => 'yz']]);
        $mapper = new UserMapper();
        /** @var User[] $list */
        $list = $mapper->selectObjs($db, (new DQuery())->where('id', '>', 1));
        $this->assertCount(2, $list);
        $this->assertSame(520, $list[0]->getId());
        $this->assertSame(120, $list[1]->getId());
        $this->assertSame('lu', $list[0]->getNick());
        $this->assertSame('yz', $list[1]->getNick());

        $list = $mapper->selectObjs($db, (new DQuery())->where('id', '>', 1), 'nick');
        $this->assertCount(2, $list);
        $this->assertSame(520, $list['lu']->getId());
        $this->assertSame(120, $list['yz']->getId());
        $this->assertSame('lu', $list['lu']->getNick());
        $this->assertSame('yz', $list['yz']->getNick());
    }

    /**
     * @throws Exception
     */
    public function testInsertAll()
    {
        $db = $this->createStub(IStorage::class);
        $this->assertSame(0, $this->mapper->insertAll($db, []));

        $list = [new User(), new User()];
        $this->assertSame(0, $this->mapper->insertAll($db, $list));

        $db->method('insertAllData')->willReturn(1);
        $mapper = new UserMapper();
        $list = [
            new User(['nick' => 'u1'], $mapper, false),
            new User(['nick' => 'u2'], $mapper, false),
        ];
        $this->assertSame(1, $this->mapper->insertAll($db, $list));
    }

    /**
     * @throws Exception
     */
    public function testStartTrans()
    {
        $db = $this->createStub(IStorage::class);
        $db->method('startTrans')->willReturn(true);
        $this->assertTrue($this->mapper->startTrans($db));
    }

    /**
     * @throws Exception
     */
    public function testCommit()
    {
        $db = $this->createStub(IStorage::class);
        $db->method('commit')->willReturn(true);
        $this->assertTrue($this->mapper->commit($db));
    }

    /**
     * @throws Exception
     */
    public function testRollback()
    {
        $db = $this->createStub(IStorage::class);
        $db->method('rollback')->willReturn(true);
        $this->assertTrue($this->mapper->rollback($db));
    }
}
