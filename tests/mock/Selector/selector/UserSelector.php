<?php declare(strict_types=1);

<<<<<<<< HEAD:tests/mock/Selector/user/UserSelector.php
namespace tests\mock\Selector\user;
========
namespace tests\mock\Selector\selector;
>>>>>>>> main:tests/mock/Selector/selector/UserSelector.php

use tests\mock\Model\user\User;
use tests\mock\Mapper\user\UserMapper;
use Norm\ORM\Model\Model;
use Norm\ORM\Selector\Selector;
use tests\mock\Mapper\user\UserMapper;
use tests\mock\Model\user\User;

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
