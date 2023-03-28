<?php declare(strict_types=1);

namespace tests\mock\Selector\user;

use tests\mock\Model\user\User;
use tests\mock\Mapper\user\UserMapper;
use Norm\ORM\Model\Model;
use Norm\ORM\Selector\Selector;

class UserSelector extends Selector
{
    protected function setModelMapper(): UserMapper
    {
        return new UserMapper();
    }

    /**
     * @return User|Model
     */
    public function createModel(): User
    {
        return parent::createModel();
    }
}
