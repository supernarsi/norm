<?php declare(strict_types=1);

namespace tests\mock\Mapper\book;

use Norm\ORM\Mapper\BasePartitionMapper;
use Norm\ORM\Model\Model;
use tests\mock\Model\book\Book;

class BookMapper extends BasePartitionMapper
{
    protected static string $tableName = 'book';
    protected string $modelName = Book::class;

    public function getPartitionIdx(string $param): string
    {
        return '_' . $param;
    }

    /**
     * @param Book $model
     * @return array
     */
    public function prepareSaveData(Model $model): array
    {
        $dbFields = ['id' => $model->getId()];
        $model->modelPropertyIsSet('id') && $dbFields['id'] = $model->getId();
        $model->modelPropertyIsSet('name') && $dbFields['name'] = $model->getName();
        return $dbFields;
    }

    /**
     * @param Book $model
     * @param array $data
     * @return Book
     */
    public function initModel(Model $model, array $data = []): Book
    {
        $model->setId((int)($data['id'] ?? 0));
        $model->setName((string)($data['name'] ?? ''));
        return $model;
    }
}
