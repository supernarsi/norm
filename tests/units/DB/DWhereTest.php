<?php

namespace tests\units\DB;

use Norm\DB\DWhere;
use PHPUnit\Framework\TestCase;

/**
 * class DWhereTest
 *
 * @package tests\units\DB
 * @covers \Norm\DB\DWhere
 */
class DWhereTest extends TestCase
{
    public function testDWhere()
    {
        $tester = new DWhere('test', '=', 1);
        $this->assertSame('test', $tester->getField());
        $this->assertSame('=', $tester->getCondition());
        $this->assertSame(1, $tester->getVal());
    }
}
