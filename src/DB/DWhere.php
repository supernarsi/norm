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
    public function __construct(string $field, string $condition, mixed $val)
    {
        $this->setField($field)->setCondition($condition)->setVal($val);
    }

    /**
     * @return string
     */
    public function getField(): string
    {
        return $this->field;
    }

    /**
     * @param string $field
     * @return DWhere
     */
    public function setField(string $field): DWhere
    {
        $this->field = $field;
        return $this;
    }

    /**
     * @return string
     */
    public function getCondition(): string
    {
        return $this->condition;
    }

    /**
     * @param string $condition
     * @return DWhere
     */
    public function setCondition(string $condition): DWhere
    {
        $this->condition = $condition;
        return $this;
    }

    /**
     * @return mixed
     */
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
