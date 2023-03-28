<?php declare(strict_types=1);

namespace tests\mock\Selector\selector;

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

    /**
     * @param int $id
     * @return ?User|Model
     */
    public function getUser(int $id): Model
    {
        return $this->mapper->findObj($this->db, $id);
    }
}
