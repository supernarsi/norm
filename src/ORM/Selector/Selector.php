<?php declare(strict_types=1);

namespace Norm\ORM\Selector;

use Norm\DB\DQuery;
use Norm\DB\IStorage;
use Norm\ORM\Mapper\Mapper;
use Norm\ORM\Model\Model;

abstract class Selector
{
    abstract protected function setModelMapper(): Mapper;

    public function __construct(protected IStorage $db, protected ?Mapper $mapper = null)
    {
        $this->db = clone $db;
        $this->mapper = $mapper ?: $this->setModelMapper();
    }

    public function getDb(): IStorage
    {
        return $this->db;
    }

    public function createModel(): Model
    {
        return $this->mapper->createModel();
    }

    public function getMapper(): Mapper
    {
        return $this->mapper;
    }

    public function insertAll(array $data): int
    {
        return $this->mapper->insertAll($this->db, $data);
    }

    public function startTrans()
    {
        return $this->mapper->startTrans($this->db);
    }


    public function commit()
    {
        return $this->mapper->commit($this->db);
    }

    public function rollback()
    {
        return $this->mapper->rollback($this->db);
    }

    public function mapperSelectObjs(Mapper $mapper, DQuery $query): array
    {
        return $mapper->selectObjs($this->db, $query);
    }

    public function mapperFindObjWhere(Mapper $mapper, DQuery $query): ?Model
    {
        return $mapper->findObjWhere($this->db, $query);
    }

    public function mapperFindObj(Mapper $mapper, int $id): ?Model
    {
        return $mapper->findObj($this->db, $id);
    }
}
