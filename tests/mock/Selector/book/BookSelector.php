<?php declare(strict_types=1);

namespace tests\mock\Selector\book;

use Norm\DB\DQuery;
use Norm\DB\DSort;
use Norm\ORM\Selector\Selector;
use tests\mock\Mapper\book\BookMapper;
use tests\mock\Model\book\Book;

class BookSelector extends Selector
{
    protected function setModelMapper(): BookMapper
    {
        return new BookMapper();
    }

    public function createModel(): Book
    {
        /** @var Book $book */
        $book = parent::createModel();
        return $book;
    }

    public function getBook(int $id): ?Book
    {
        /** @var ?Book $book */
        $book = $this->mapper->findObj($this->db, $id);
        return $book;
    }

    /**
     * @return Book[]
     */
    public function getBookList(): array
    {
        $query = (new DQuery())->where('status', '=', 1)->order('id', DSort::Desc);
        return $this->mapper->selectObjs($this->db, $query);
    }
}
