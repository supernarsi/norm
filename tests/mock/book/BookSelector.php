<?php declare(strict_types=1);

namespace tests\mock\book;

use Norm\ORM\Model\Model;
use Norm\ORM\Selector\Selector;

class BookSelector extends Selector
{
    protected function setModelMapper(): BookMapper
    {
        return new BookMapper();
    }

    /**
     * @return Book|Model
     */
    public function createModel(): Book
    {
        return parent::createModel();
    }

    /**
     * @param int $id
     * @return ?Book
     */
    public function getBook(int $id): Model
    {
        return $this->mapper->findObj($this->db, $id);
    }
}
