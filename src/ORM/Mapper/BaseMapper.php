<?php declare(strict_types=1);

namespace Norm\ORM\Mapper;

use Norm\DB\DQuery;
use Norm\DB\IStorage;
use Norm\ORM\Model\Model;

abstract class BaseMapper implements Mapper
{
    /** @var string $modelName must extend the Norm\ORM\Model */
    protected string $modelName;
    protected static string $tableName;

    abstract public function getTableName(bool $isPartition, string $partitionIdx, bool $prefixMod = false): string;

    public function getPartitionTableName(string $partitionIdx, bool $prefixMod = false): string
    {
        return $prefixMod ? $partitionIdx . self::$tableName : self::$tableName . $partitionIdx;
    }

    protected function newModel(array $modelData, bool $unsetProperty): Model
    {
        return new $this->modelName($modelData, $this, $unsetProperty);
    }

    protected function resetDb(?IStorage $db)
    {
        $db && $db->init($this->getTableName());
    }

    public function createModel(): Model
    {
        return $this->newModel([], false);
    }

    public function update(IStorage $db, array $data): bool
    {
        $this->resetDb($db);
        return $db->updateData($data);
    }

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

    public function findWhere(IStorage $db, DQuery $query): array
    {
        $this->resetDb($db);
        return $db->setCondition($query)->findData();
    }

    public function select(IStorage $db, DQuery $query, string $fields = ''): array
    {
        $this->resetDb($db);
        return $db->setCondition($query)->selectData($fields);
    }

    public function find(IStorage $db, int $id): array
    {
        $query = (new DQuery())->where('id', '=', $id);
        return $this->findWhere($db, $query);
    }

    public function findObj(IStorage $db, int $id): ?Model
    {
        $data = $this->find($db, $id);
        return $data ? $this->newModel($data, true) : null;
    }

    public function findObjWhere(IStorage $db, DQuery $query): ?Model
    {
        $data = $this->findWhere($db, $query);
        return $data ? $this->newModel($data, true) : null;
    }

    /**
     * @param IStorage $db
     * @param DQuery $query
     * @param string $field
     * @return Model[]
     */
    public function selectObjs(IStorage $db, DQuery $query, string $field = ''): array
    {
        foreach ($this->select($db, $query) as $item) {
            $nowObj = $this->newModel($item, true);
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

    public function startTrans(IStorage $db): bool
    {
        $this->resetDb($db);
        return $db->startTrans();
    }

    public function commit(IStorage $db): bool
    {
        $this->resetDb($db);
        return $db->commit();
    }

    public function rollback(IStorage $db): bool
    {
        $this->resetDb($db);
        return $db->rollback();
    }
}
