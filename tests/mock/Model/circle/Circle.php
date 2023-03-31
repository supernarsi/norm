<?php declare(strict_types=1);

namespace tests\mock\Model\circle;

use Norm\ORM\Model\Model;

class Circle extends Model
{
    protected int $id = 0;
    protected int $cateId = 0;
    protected string $circleName = '';
    protected string $circleDesc = '';
    protected int $sort = 0;
    protected int $status = 0;
    protected int $level = 0;
    protected int $type = 0;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Circle
    {
        return $this->setProperty('id', $id);
    }

    public function getCateId(): int
    {
        return $this->cateId;
    }

    public function setCateId(int $cateId): Circle
    {
        return $this->setProperty('cateId', $cateId);
    }

    public function getCircleName(): string
    {
        return $this->circleName;
    }

    public function setCircleName(string $circleName): Circle
    {
        return $this->setProperty('circleName', $circleName);
    }

    public function getCircleDesc(): string
    {
        return $this->circleDesc;
    }

    public function setCircleDesc(string $circleDesc): Circle
    {
        return $this->setProperty('circleDesc', $circleDesc);
    }

    public function getSort(): int
    {
        return $this->sort;
    }

    public function setSort(int $sort): Circle
    {
        return $this->setProperty('sort', $sort);
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): Circle
    {
        return $this->setProperty('status', $status);
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function setLevel(int $level): Circle
    {
        return $this->setProperty('level', $level);
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function setType(int $type): Circle
    {
        return $this->setProperty('type', $type);
    }

    public function render(): array
    {
        return [
            'id' => $this->getId(),
            'cate_id' => $this->getCateId(),
            'circle_name' => $this->getCircleName(),
            'circle_desc' => $this->getCircleDesc(),
            'sort' => $this->getSort(),
            'status' => $this->getStatus(),
            'level' => $this->getLevel(),
            'type' => $this->getType(),
        ];
    }
}
