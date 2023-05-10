<?php

namespace tests\units\DB;

use Norm\DB\DQuery;
use Norm\DB\DSort;
use Norm\DB\DWhere;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(DQuery::class), CoversClass(DWhere::class)]
class DQueryTest extends TestCase
{
    public function testDQuery()
    {
        $query = (new DQuery())
            ->where('test', '>=', 12)
            ->where('test2', '=', 'dd')
            ->order('weight')
            ->order('sort', DSort::Desc)
            ->orderField('k1', ['v1', 'v2'])
            ->page(1, 2);

        // test where
        $whereList = $query->getWhere();
        $this->assertCount(2, $whereList);
        $this->assertSame('test', $whereList[0]->getField());
        $this->assertSame('>=', $whereList[0]->getCondition());
        $this->assertSame(12, $whereList[0]->getVal());
        $this->assertSame('test2', $whereList[1]->getField());
        $this->assertSame('=', $whereList[1]->getCondition());
        $this->assertSame('dd', $whereList[1]->getVal());

        // test page & limit
        $this->assertSame(1, $query->getPage());
        $this->assertSame(2, $query->getLimit());

        // test order
        $orders = $query->getOrders();
        $this->assertCount(2, $orders);
        $this->assertSame('desc', $orders['sort']);
        $this->assertSame('asc', $orders['weight']);

        // test order field
        $this->assertSame('k1', $query->getOrderField());
        $this->assertSame(['v1', 'v2'], $query->getOrderFieldVal());
    }
}
