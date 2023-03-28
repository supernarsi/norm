<?php

namespace tests\mock\article;

use Norm\ORM\Model\SModel;

class Article extends SModel
{
    protected int $id = 0;
    protected string $title = '';

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Article
    {
        return $this->setProperty('id', $id);
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): Article
    {
        return $this->setProperty('title', $title);
    }

    public function render(): array
    {
        return ['id' => $this->getId(), 'title' => $this->getTitle()];
    }
}
