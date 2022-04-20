<?php declare(strict_types=1);

namespace Norm\ORM\Model;

abstract class SModel extends Model
{
    public function __sleep()
    {
        foreach ($this as $field => $val) {
            // 序列化时，排除 beSetProperties 和 mapper 属性
            $field != 'beSetProperties' && $field != 'mapper' && $serializeFields[] = $field;
        }
        return $serializeFields ?? [];
    }
}
