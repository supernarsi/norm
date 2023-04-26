<?php declare(strict_types=1);

namespace tests\mock\Model\Channel;

use Norm\ORM\Model\Model;

class Channel extends Model
{
    protected int $id = 0;
    protected string $title = '';
    protected string $alias = '';

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Channel
    {
        return $this->setProperty('id', $id);
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): Channel
    {
        return $this->setProperty('title', $title);
    }

    public function getAlias(): string
    {
        return $this->alias;
    }

    public function setAlias(string $alias): Channel
    {
        return $this->setProperty('alias', $alias);
    }

    public function render(): array
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'alias' => $this->getAlias(),
        ];
    }
}
