<?php

namespace tests\units\ORM\Model;

use Norm\DB\DQuery;
use Norm\DB\DWhere;
use Norm\DB\IStorage;
use Norm\ORM\Mapper\BaseMapper;
use Norm\ORM\Model\Model;
use Norm\ORM\Model\SModel;
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
    CoversClass(SModel::class),
    UsesClass(User::class),
    UsesClass(UserMapper::class),
]
class UserTest extends TestCase
{
    private IStorage $db;

    /**
     * @throws Exception
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->db = $this->createStub(IStorage::class);
    }

    public function testGetMapper()
    {
        $tester = new User();
        $this->assertNull($tester->getMapper());

        $mapper = new UserMapper();
        $tester = new User([], $mapper);
        $this->assertInstanceOf(UserMapper::class, $tester->getMapper());
    }

    public function testGetModelProperties()
    {
        $userData = ['id' => 42, 'nick' => 'init-name'];
        $tester = new User($userData, new UserMapper(), false);
        $result = $tester->getModelProperties();
        $this->assertTrue($result['id']);
        $this->assertTrue($result['nick']);
        $this->assertSame([], $result['beSetProperties']);
        $this->assertCount(3, $result);
    }

    public function testGetModelFields()
    {
        // case1
        $tester = new User();
        $this->assertSame(['test'], $tester->getModelFields(['test']));
        $this->assertSame([], $tester->getModelFields());

        // case2
        $userData = ['id' => 42, 'nick' => 'init-name'];
        $tester = new User($userData, new UserMapper());
        $this->assertSame(['test'], $tester->getModelFields(['test']));
        $this->assertSame(['id' => 42], $tester->getModelFields());

        // case3
        $userData = ['id' => 42, 'nick' => 'init-name-42'];
        $tester = new User($userData, new UserMapper(), false);
        $this->assertSame(['test'], $tester->getModelFields(['test']));
        $this->assertSame(['id' => 42, 'nick' => 'init-name-42'], $tester->getModelFields());
    }

    /**
     * @throws Exception
     */
    public function testInsert()
    {
        // case1: no mapper
        $tester = new User();
        $this->assertNull($tester->insert($this->db));

        // case2: mapper insert return 0
        $mapper = $this->createStub(UserMapper::class);
        $mapper->method('insert')->willReturn(0);
        $tester = new User([], $mapper);
        $this->assertNull($tester->insert($this->db));

        // case3: mapper insert successfully and initModel return right Model
        $mapper = $this->createStub(UserMapper::class);
        $mapper->method('insert')->willReturn(43);
        $mapper->method('initModel')->willReturn((new User())->setId(43)->setNick('new-user'));
        $tester = new User(['nick' => 'new-user'], $mapper, false);
        $newUser = $tester->insert($this->db);
        $this->assertInstanceOf(User::class, $newUser);
        $this->assertSame(43, $newUser->getId());
        //$this->assertSame('new-user', $newUser->getNick());
    }

    /**
     * @throws Exception
     */
    public function testUpdate()
    {
        // case1: no mapper
        $tester = new User();
        $this->assertNull($tester->update($this->db));

        // case2: update failed
        $mapper = $this->createStub(UserMapper::class);
        $mapper->method('update')->willReturn(false);
        $tester = new User([], $mapper);
        $this->assertNull($tester->update($this->db));

        // case3: update successfully
        $mapper = $this->createStub(UserMapper::class);
        $mapper->method('update')->willReturn(true);
        $tester = new User([], $mapper);
        $this->assertInstanceOf(User::class, $tester->update($this->db));
    }

    public function testSave()
    {
        // case1: update successfully
        $tester = $this->getMockBuilder(User::class)->onlyMethods(['getId', 'update', 'insert'])->getMock();
        $tester->method('getId')->willReturn(1);
        $tester->method('update')->willReturn(new User());
        $this->assertInstanceOf(User::class, $tester->save($this->db));

        // case2: update failed
        $tester = $this->getMockBuilder(User::class)->onlyMethods(['getId', 'update', 'insert'])->getMock();
        $tester->method('getId')->willReturn(1);
        $tester->method('update')->willReturn(null);
        $this->assertNull($tester->save($this->db));

        // case3: insert successfully
        $tester = $this->getMockBuilder(User::class)->onlyMethods(['getId', 'update', 'insert'])->getMock();
        $tester->method('getId')->willReturn(0);
        $tester->method('insert')->willReturn(new User());
        $this->assertInstanceOf(User::class, $tester->save($this->db));

        // case4: insert failed
        $tester = $this->getMockBuilder(User::class)->onlyMethods(['getId', 'update', 'insert'])->getMock();
        $tester->method('getId')->willReturn(0);
        $tester->method('insert')->willReturn(null);
        $this->assertNull($tester->save($this->db));
    }

    /**
     * @throws Exception
     */
    public function testDelete()
    {
        $tester = (new User());
        $this->assertFalse($tester->delete($this->db));

        $mapper = $this->createStub(UserMapper::class);
        $mapper->method('delete')->willReturn(false);
        $tester = (new User([], $mapper))->setId(1);
        $this->assertFalse($tester->delete($this->db));

        $mapper = $this->createStub(UserMapper::class);
        $mapper->method('delete')->willReturn(true);
        $tester = (new User([], $mapper))->setId(1);
        $this->assertTrue($tester->delete($this->db));
    }

    public function testRender()
    {
        $tester = (new User());
        $this->assertSame(['id' => 0, 'nick' => ''], $tester->render());
    }

    public function testSerialize()
    {
        $tester = (new User())->setId(123)->setNick('nick-test');
        $serializedUser = serialize($tester);
        $unSerializeUser = unserialize($serializedUser);
        $this->assertInstanceOf(User::class, $unSerializeUser);
        $this->assertSame(123, $unSerializeUser->getId());
        $unSerializeUser->setId(321);
        $this->assertSame(321, $unSerializeUser->getId());
    }
}
