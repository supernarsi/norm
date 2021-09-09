<?php declare(strict_types=1);

namespace Norm\ORM\Mapper;

use Norm\DB\DQuery;
use Norm\DB\IStorage;
use Norm\ORM\Model\Model;

abstract class BaseMapper implements Mapper
{
    protected static string $modelName;

    abstract public function getTableName(): string;

    /**
     * @param IStorage|null $db
     */
    protected function resetDb(?IStorage $db)
    {
        $db && $db->init($this->getTableName());
    }

    /**
     * @param IStorage $db
     * @param array $data
     * @return bool
     */
    public function update(IStorage $db, array $data): bool
    {
        $this->resetDb($db);
        return $db->updateData($data);
    }

    /**
     * @param IStorage $db
     * @param array $data
     * @return int
     */
    public function insert(IStorage $db, array $data): int
    {
        $this->resetDb($db);
        return $db->insertDataGetId($data);
    }

    public function delete(IStorage $db, DQuery $query): bool
    {
        $this->resetDb($db);
        return $db->setCondition($query)->deleteData();
    }

    public function count(IStorage $db, DQuery $query): int
    {
        $this->resetDb($db);
        return $db->setCondition($query)->count();
    }

    public function sum(IStorage $db, DQuery $query, string $field): float
    {
        $this->resetDb($db);
        return $db->setCondition($query)->sum($field);
    }

    /**
     * @param IStorage $db
     * @param DQuery $query
     * @return array
     */
    public function findWhere(IStorage $db, DQuery $query): array
    {
        $this->resetDb($db);
        return $db->setCondition($query)->findData();
    }

    /**
     * @param IStorage $db
     * @param DQuery $query
     * @return array
     */
    public function select(IStorage $db, DQuery $query): array
    {
        $this->resetDb($db);
        return $db->setCondition($query)->selectData();
    }

    /**
     * @param IStorage $db
     * @param int $id
     * @return array
     */
    public function find(IStorage $db, int $id): array
    {
        $query = (new DQuery())->where('id', '=', $id);
        return $this->findWhere($db, $query);
    }

    /**
     * @param IStorage $db
     * @param int $id
     * @return Model|null
     */
    public function findObj(IStorage $db, int $id): ?Model
    {
        $data = $this->find($db, $id);
        return $data ? new static::$modelName($data, $this) : null;
    }


    /**
     * @param IStorage $db
     * @param DQuery $query
     * @return Model|null
     */
    public function findObjWhere(IStorage $db, DQuery $query): ?Model
    {
        $data = $this->findWhere($db, $query);
        return $data ? new static::$modelName($data, $this) : null;
    }

    /**
     * @param IStorage $db
     * @param DQuery $query
     * @param string $field
     * @return array
     */
    public function selectObjs(IStorage $db, DQuery $query, string $field = ''): array
    {
        foreach ($this->select($db, $query) as $item) {
            $nowObj = new static::$modelName($item, $this);
            if ($field && isset($item[$field])) {
                $objs[$item[$field]] = $nowObj;
            } else {
                $objs[] = $nowObj;
            }
        }
        return $objs ?? [];
    }

    /**
     * @param IStorage $db
     * @param Model[] $list
     * @return int
     */
    public function insertAll(IStorage $db, array $list): int
    {
        $insertData = [];
        foreach ($list as $item) {
            ($item instanceof Model) && $item->getMapper() && $insertData[] = $item->getModelFields();
        }
        if (!$insertData) {
            return 0;
        }
        $this->resetDb($db);
        return $db->insertAllData($insertData);
    }

    /**
     * @return Model
     */
    abstract public function createModel(): Model;

    /**
     * @param IStorage $db
     * @return bool
     */
    public function startTrans(IStorage $db): bool
    {
        $this->resetDb($db);
        return $db->startTrans();
    }

    /**
     * @param IStorage $db
     * @return bool
     */
    public function commit(IStorage $db): bool
    {
        $this->resetDb($db);
        return $db->commit();
    }

    /**
     * @param IStorage $db
     * @return bool
     */
    public function rollback(IStorage $db): bool
    {
        $this->resetDb($db);
        return $db->rollback();
    }
}
