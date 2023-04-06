<?php declare(strict_types=1);

namespace tests\mock\Model\app;

use Norm\ORM\Model\Model;

class AppData extends Model
{
    protected int $id = 0;
    protected string $data = '';
    protected string $createTime = '';

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): AppData
    {
        return $this->setProperty('id', $id);
    }

    public function getData(): string
    {
        return $this->data;
    }

    public function setData(string $data): AppData
    {
        return $this->setProperty('data', $data);
    }

    public function getCreateTime(): string
    {
        return $this->createTime;
    }

    public function setCreateTime(string $createTime): AppData
    {
        return $this->setProperty('createTime', $createTime);
    }

    public function render(): array
    {
        return [
            'id' => $this->getId(),
            'data' => $this->getData(),
            'create_time' => $this->getCreateTime(),
        ];
    }
}
