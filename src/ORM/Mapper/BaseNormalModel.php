<?php

namespace Norm\ORM\Mapper;

abstract class BaseNormalModel extends BaseMapper
{
    public function getTableName(): string
    {
        return self::$baseTableName;
    }
}
