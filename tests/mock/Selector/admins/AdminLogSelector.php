<?php declare(strict_types=1);

namespace tests\mock\Selector\admins;

use tests\mock\Model\admins\AdminLog;
use tests\mock\Mapper\admins\AdminLogMapper;
use Norm\ORM\Model\Model;
use Norm\ORM\Selector\Selector;

class AdminLogSelector extends Selector
{
    protected function setModelMapper(): AdminLogMapper
    {
        return new AdminLogMapper();
    }

    /**
     * @return AdminLog|Model
     */
    public function createModel(): AdminLog
    {
        return parent::createModel();
    }
}
