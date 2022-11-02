<?php declare(strict_types=1);

namespace Norm\ORM\Mapper;

use Norm\DB\DQuery;
use Norm\DB\IStorage;
use Norm\ORM\Model\Model;

interface Mapper
{
    public function prepareSaveData(Model $model): array;

    public function initModel(Model $model, array $data = []): Model;

    public function createModel(): Model;

    public function insert(IStorage $db, array $data): int;

    public function update(IStorage $db, array $data): bool;

    public function delete(IStorage $db, DQuery $query): bool;

    public function insertAll(IStorage $db, array $list): int;

    public function find(IStorage $db, int $id): array;

    public function findWhere(IStorage $db, DQuery $query);

    public function findObj(IStorage $db, int $id): ?Model;

    public function findObjWhere(IStorage $db, DQuery $query): ?Model;

    public function select(IStorage $db, DQuery $query, string $fields = ''): array;

    public function selectObjs(IStorage $db, DQuery $query, string $field = ''): array;

    public function count(IStorage $db, DQuery $query): int;

    public function sum(IStorage $db, DQuery $query, string $field): float;

    public function startTrans(IStorage $db);

    public function commit(IStorage $db);

    public function rollback(IStorage $db);
}
