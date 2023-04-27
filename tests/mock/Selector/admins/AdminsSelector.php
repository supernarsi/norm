<?php declare(strict_types=1);

namespace tests\mock\Selector\admins;

use tests\mock\Model\admins\Admins;
use tests\mock\Mapper\admins\AdminsMapper;
use Norm\ORM\Model\Model;
use Norm\ORM\Selector\Selector;

class AdminsSelector extends Selector
{
    protected function setModelMapper(): AdminsMapper
    {
        return new AdminsMapper();
    }

    /**
     * @return Admins|Model
     */
    public function createModel(): Admins
    {
        return parent::createModel();
    }
}
