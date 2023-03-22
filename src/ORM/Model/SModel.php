<?php declare(strict_types=1);

namespace Norm\ORM\Model;

abstract class SModel extends Model
{
    public function __sleep()
    {
        foreach ($this as $field => $val) {
            $field != 'beSetProperties' && $field != 'mapper' && $serializeFields[] = $field;
        }
        return $serializeFields ?? [];
    }
}
