<?php

namespace tests\units\DB;

use Norm\DB\DWhere;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(DWhere::class)]
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
