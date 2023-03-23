<?php declare(strict_types=1);

namespace tests\mock\book;

use Norm\ORM\Model\SModel;

class Book extends SModel
{
    protected int $id = 0;
    protected string $name = '';

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Book
    {
        return $this->setProperty('id', $id);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Book
    {
        return $this->setProperty('name', $name);
    }

    public function render(): array
    {
        return ['id' => $this->getId(), 'name' => $this->getName()];
    }
}
