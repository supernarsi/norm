<?php declare(strict_types=1);

namespace tests\mock\Model\user;

use Norm\ORM\Model\SModel;

class User extends SModel
{
    protected int $id = 0;
    protected string $nick = '';

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId(int $id): User
    {
        return $this->setProperty('id', $id);
    }

    /**
     * @return string
     */
    public function getNick(): string
    {
        return $this->nick;
    }

    /**
     * @param string $nick
     * @return User
     */
    public function setNick(string $nick): User
    {
        return $this->setProperty('nick', $nick);
    }

    public function render(): array
    {
        return ['id' => $this->getId(), 'nick' => $this->getNick()];
    }
}
