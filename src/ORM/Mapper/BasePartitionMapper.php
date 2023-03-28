<?php

namespace Norm\ORM\Mapper;

abstract class BasePartitionMapper extends BaseMapper
{
    private string $partitionIdx;
    private bool $isPrefixMod;

    abstract public function getPartitionIdx(string $param): string;

    public function __construct(string $partitionIdx, bool $isPrefixMod = false)
    {
        $this->partitionIdx = $partitionIdx;
        $this->isPrefixMod = $isPrefixMod;
    }

    public function getTableName(): string
    {
        return $this->getPartitionTableName($this->partitionIdx, $this->isPrefixMod);
    }

    public function getPartitionTableName(string $partitionIdx, bool $prefixMod = false): string
    {
        return $prefixMod ? $partitionIdx . self::$baseTableName : self::$baseTableName . $partitionIdx;
    }
}
