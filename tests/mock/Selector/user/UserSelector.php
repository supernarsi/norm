<?php

namespace tests\mock\Selector\user;

use Norm\ORM\Selector\Selector;
use tests\mock\Mapper\user\UserMapper;
use tests\mock\Model\user\User;

class UserSelector extends Selector
{
    protected function setModelMapper(): UserMapper
    {
        return new UserMapper();
    }

    public function createModel(): User
    {
        /** @var User $model */
        $model = parent::createModel();
        return $model;
    }

    public function getUser(int $id): ?User
    {
        /** @var ?User $user */
        $user = $this->mapper->findObj($this->db, $id);
        return $user;
    }
}
