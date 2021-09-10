<?php declare(strict_types=1);

namespace tests\mock\Model;

use Norm\ORM\Model\Model;

class Ana extends Model
{
    protected int $id = 0;
    protected string $ana = '';
    protected string $author = '';

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Ana
    {
        return $this->setProperty('id', $id);
    }

    public function getAna(): string
    {
        return $this->ana;
    }

    public function setAna(string $ana): Ana
    {
        return $this->setProperty('ana', $ana);
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function setAuthor(string $author): Ana
    {
        return $this->setProperty('author', $author);
    }

    public function render(): array
    {
        return [
            'id' => $this->getId(),
            'ana' => $this->getAna(),
            'author' => $this->getAuthor(),
        ];
    }
}
