<?php declare(strict_types=1);

namespace Norm\DB;

/**
 * Class DQuery
 *
 * @package Norm\DB
 */
class DQuery
{
    public const ASC = 1;
    public const DESC = 2;

    /** @var DWhere[] */
    protected array $where = [];
    /** @var array */
    protected array $orders = [];
    /** @var string */
    protected string $orderField = '';
    /** @var array */
    protected array $orderFieldVal = [];
    /** @var int */
    protected int $page = 0;
    /** @var int */
    protected int $limit = 0;

    /**
     * @return DWhere[]
     */
    public function getWhere(): array
    {
        return $this->where;
    }

    /**
     * @param DWhere[] $where
     * @return DQuery
     */
    public function setWhere(array $where): DQuery
    {
        $this->where = $where;
        return $this;
    }

    /**
     * @return array
     */
    public function getOrders(): array
    {
        return $this->orders;
    }

    /**
     * @param array $orders
     * @return DQuery
     */
    public function setOrders(array $orders): DQuery
    {
        $this->orders = $orders;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderField(): string
    {
        return $this->orderField;
    }

    /**
     * @param string $orderField
     * @return DQuery
     */
    public function setOrderField(string $orderField): DQuery
    {
        $this->orderField = $orderField;
        return $this;
    }

    /**
     * @return array
     */
    public function getOrderFieldVal(): array
    {
        return $this->orderFieldVal;
    }

    /**
     * @param array $orderFieldVal
     * @return DQuery
     */
    public function setOrderFieldVal(array $orderFieldVal): DQuery
    {
        $this->orderFieldVal = $orderFieldVal;
        return $this;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     * @return DQuery
     */
    public function setPage(int $page): DQuery
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     * @return DQuery
     */
    public function setLimit(int $limit): DQuery
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * 设置查询条件
     *
     * @param string $field
     * @param string $condition
     * @param mixed $val
     * @return $this
     */
    public function where(string $field, string $condition, $val): DQuery
    {
        $this->where[] = new DWhere($field, $condition, $val);
        return $this;
    }

    /**
     * 设置排序条件
     *
     * @param string $field
     * @param int $sortType
     * @return $this
     */
    public function order(string $field, int $sortType = self::ASC): DQuery
    {
        $this->orders[$field] = $sortType == self::DESC ? 'desc' : 'asc';
        return $this;
    }

    /**
     * 根据字段值排序
     *
     * @param string $field
     * @param array $orderVal
     * @return $this
     */
    public function orderField(string $field, array $orderVal): DQuery
    {
        $field && $orderVal && $this->setOrderField($field)->setOrderFieldVal($orderVal);
        return $this;
    }

    /**
     * 设置页码
     *
     * @param int $page
     * @param int $limit
     * @return $this
     */
    public function page(int $page, int $limit): DQuery
    {
        $this->page = $page;
        $this->limit = $limit;
        return $this;
    }
}
