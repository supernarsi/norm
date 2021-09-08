<?php declare(strict_types=1);

namespace Norm\DB;

interface IStorage
{
    /**
     * @param string $name
     * @return $this
     */
    public function init(string $name): self;

    /**
     * @param DQuery $query
     * @return $this
     */
    public function setCondition(DQuery $query): self;

    /**
     * @return array
     */
    public function selectData(): array;

    /**
     * @return array
     */
    public function findData(): array;

    /**
     * @param array $list
     * @return int
     */
    public function insertAllData(array $list): int;

    /**
     * @param array $data
     * @return bool
     */
    public function insertData(array $data): bool;

    /**
     * @param array $data
     * @return int
     */
    public function insertDataGetId(array $data): int;

    /**
     * @param array $data
     * @return bool
     */
    public function updateData(array $data): bool;

    /**
     * @return bool
     */
    public function deleteData(): bool;

    /**
     * @return int
     */
    public function count(): int;

    /**
     * @param string $field
     * @return float
     */
    public function sum(string $field): float;

    /**
     * @return bool
     */
    public function startTrans(): bool;

    /**
     * @return bool
     */
    public function commit(): bool;

    /**
     * @return bool
     */
    public function rollback(): bool;
}
