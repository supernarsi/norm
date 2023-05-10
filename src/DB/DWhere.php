<?php declare(strict_types=1);

namespace Norm\DB;

class DWhere
{
    public function __construct(private string $field, private string $condition, protected mixed $val)
    {
        $this->setField($field)->setCondition($condition)->setVal($val);
    }

    public function getField(): string
    {
        return $this->field;
    }


    public function setField(string $field): DWhere
    {
        $this->field = $field;
        return $this;
    }

    public function getCondition(): string
    {
        return $this->condition;
    }

    public function setCondition(string $condition): DWhere
    {
        $this->condition = $condition;
        return $this;
    }

    public function getVal(): mixed
    {
        return $this->val;
    }

    public function setVal(mixed $val): DWhere
    {
        $this->val = $val;
        return $this;
    }
}
