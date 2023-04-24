<?php declare(strict_types=1);

namespace tests\mock\Selector\admins;

use tests\mock\Model\admins\AdminRole;
use tests\mock\Mapper\admins\AdminRoleMapper;
use Norm\ORM\Model\Model;
use Norm\ORM\Selector\Selector;

class AdminRoleSelector extends Selector
{
    protected function setModelMapper(): AdminRoleMapper
    {
        return new AdminRoleMapper();
    }

    /**
     * @return AdminRole|Model
     */
    public function createModel(): AdminRole
    {
        return parent::createModel();
    }
}
