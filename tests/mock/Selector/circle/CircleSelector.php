<?php declare(strict_types=1);

namespace tests\mock\Selector\circle;

use tests\mock\Model\circle\Circle;
use tests\mock\Mapper\circle\CircleMapper;
use Norm\ORM\Model\Model;
use Norm\ORM\Selector\Selector;

class CircleSelector extends Selector
{
    protected function setModelMapper(): CircleMapper
    {
        return new CircleMapper();
    }

    /**
     * @return Circle|Model
     */
    public function createModel(): Circle
    {
        return parent::createModel();
    }
}
