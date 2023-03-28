<?php declare(strict_types=1);

namespace Norm\DB;

/**
 * Class DWhere
 *
 * @package Norm\DB
 */
class DWhere
{
    /** @var string */
    private string $field;
    /** @var string */
    private string $condition;
    /** @var mixed */
    private $val;

    /**
     * DWhere constructor.
     *
     * @param string $field
     * @param string $condition
     * @param mixed $val
     */
    public function __construct(string $field, string $condition, $val)
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

    public function getVal()
    {
        return $this->val;
    }

    /**
     * @param mixed $val
     * @return DWhere
     */
    public function setVal($val): DWhere
    {
        $this->val = $val;
        return $this;
    }
}
