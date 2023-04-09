<?php declare(strict_types=1);

namespace tests\mock\Model\admins;

use Norm\ORM\Model\Model;

class Admins extends Model
{
    protected int $id = 0;
    protected string $username = '';
    protected string $password = '';
    protected string $avatar = '';
    protected string $email = '';
    protected int $status = 0;
    protected int $role = 0;
    protected int $roleId = 0;
    protected int $ctime = 0;
    protected int $mtime = 0;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Admins
    {
        return $this->setProperty('id', $id);
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): Admins
    {
        return $this->setProperty('username', $username);
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): Admins
    {
        return $this->setProperty('password', $password);
    }

    public function getAvatar(): string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): Admins
    {
        return $this->setProperty('avatar', $avatar);
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): Admins
    {
        return $this->setProperty('email', $email);
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): Admins
    {
        return $this->setProperty('status', $status);
    }

    public function getRole(): int
    {
        return $this->role;
    }

    public function setRole(int $role): Admins
    {
        return $this->setProperty('role', $role);
    }

    public function getRoleId(): int
    {
        return $this->roleId;
    }

    public function setRoleId(int $roleId): Admins
    {
        return $this->setProperty('roleId', $roleId);
    }

    public function getCtime(): int
    {
        return $this->ctime;
    }

    public function setCtime(int $ctime): Admins
    {
        return $this->setProperty('ctime', $ctime);
    }

    public function getMtime(): int
    {
        return $this->mtime;
    }

    public function setMtime(int $mtime): Admins
    {
        return $this->setProperty('mtime', $mtime);
    }

    public function render(): array
    {
        return [
            'id' => $this->getId(),
            'username' => $this->getUsername(),
            'password' => $this->getPassword(),
            'avatar' => $this->getAvatar(),
            'email' => $this->getEmail(),
            'status' => $this->getStatus(),
            'role' => $this->getRole(),
            'role_id' => $this->getRoleId(),
            'ctime' => $this->getCtime(),
            'mtime' => $this->getMtime(),
        ];
    }
}
