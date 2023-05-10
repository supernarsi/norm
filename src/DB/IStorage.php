<?php declare(strict_types=1);

namespace Norm\DB;

interface IStorage
{
    public function init(string $name): self;

    public function setCondition(DQuery $query): self;

    public function selectData(string $fields = ''): array;

    public function findData(): array;

    public function insertAllData(array $list): int;

    public function insertData(array $data): bool;

    public function insertDataGetId(array $data): int;

    public function updateData(array $data): bool;

    public function deleteData(): bool;

    public function count(): int;

    public function sum(string $field): float;

    public function startTrans(): bool;

    public function commit(): bool;

    public function rollback(): bool;
}
