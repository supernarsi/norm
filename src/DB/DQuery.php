<?php declare(strict_types=1);

namespace Norm\DB;

class DQuery
{
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

    public function getOrders(): array
    {
        return $this->orders;
    }

    public function getOrderField(): string
    {
        return $this->orderField;
    }

    public function setOrderField(string $orderField): DQuery
    {
        $this->orderField = $orderField;
        return $this;
    }

    public function getOrderFieldVal(): array
    {
        return $this->orderFieldVal;
    }

    public function setOrderFieldVal(array $orderFieldVal): DQuery
    {
        $this->orderFieldVal = $orderFieldVal;
        return $this;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function setPage(int $page): DQuery
    {
        $this->page = $page;
        return $this;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function setLimit(int $limit): DQuery
    {
        $this->limit = $limit;
        return $this;
    }

    public function where(string $field, string $condition, mixed $val): DQuery
    {
        $this->where[] = new DWhere($field, $condition, $val);
        return $this;
    }

    public function order(string $field, DSort $sortType = DSort::Asc): DQuery
    {
        match ($sortType) {
            DSort::Asc => $this->orders[$field] = 'asc',
            DSort::Desc => $this->orders[$field] = 'desc',
        };
        return $this;
    }

    public function orderField(string $field, array $orderVal): DQuery
    {
        $field && $orderVal && $this->setOrderField($field)->setOrderFieldVal($orderVal);
        return $this;
    }

    public function page(int $page, int $limit): DQuery
    {
        return $this->setPage($page)->setLimit($limit);
    }
}
