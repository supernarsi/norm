<?php declare(strict_types=1);

namespace tests\mock;

use Norm\ORM\Selector\Selector;

class UserSelector extends Selector
{
    protected function setModelMapper(): UserMapper
    {
        return new UserMapper();
    }

    /**
     * @return User
     */
    public function createModel(): User
    {
        return parent::createModel();
    }

    /**
     * @param int $id
     * @return User|null
     */
    public function getUser(int $id): ?User
    {
        return $this->mapper->findObj($this->db, $id);
    }
}
