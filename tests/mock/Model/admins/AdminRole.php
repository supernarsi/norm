<?php declare(strict_types=1);

namespace tests\mock\Model\admins;

use Norm\ORM\Model\Model;

class AdminRole extends Model
{
    protected int $id = 0;
    protected string $name = '';
    protected int $ctime = 0;
    protected int $mtime = 0;
    protected int $status = 0;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): AdminRole
    {
        return $this->setProperty('id', $id);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): AdminRole
    {
        return $this->setProperty('name', $name);
    }

    public function getCtime(): int
    {
        return $this->ctime;
    }

    public function setCtime(int $ctime): AdminRole
    {
        return $this->setProperty('ctime', $ctime);
    }

    public function getMtime(): int
    {
        return $this->mtime;
    }

    public function setMtime(int $mtime): AdminRole
    {
        return $this->setProperty('mtime', $mtime);
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): AdminRole
    {
        return $this->setProperty('status', $status);
    }

    public function render(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'ctime' => $this->getCtime(),
            'mtime' => $this->getMtime(),
            'status' => $this->getStatus(),
        ];
    }
}
