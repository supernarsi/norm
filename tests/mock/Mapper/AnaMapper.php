<?php declare(strict_types=1);

namespace tests\mock\Mapper;

use tests\mock\Model\Ana;
use Norm\ORM\Mapper\BaseMapper;
use Norm\ORM\Model\Model;

class AnaMapper extends BaseMapper
{
    protected static string $tableName = 'ana';
    protected string $modelName = Ana::class;

    public function getTableName(): string
    {
        return self::$tableName;
    }

    /**
     * @param Model|Ana $model
     * @param array $data
     * @return Ana
     */
    public function initModel(Model $model, array $data = []): Ana
    {
        $model->setId((int)($data['id'] ?? 0));
        $model->setAna((string)($data['ana'] ?? ''));
        $model->setAuthor((string)($data['author'] ?? ''));

        return $model;
    }
    /**
     * @param Model|Ana $model
     * @return array
     */
    public function prepareSaveData(Model $model): array
    {
        $dbFields = ['id' => $model->getId()];
        $model->modelPropertyIsSet('id') && $dbFields['id'] = $model->getId();
        $model->modelPropertyIsSet('ana') && $dbFields['ana'] = $model->getAna();
        $model->modelPropertyIsSet('author') && $dbFields['author'] = $model->getAuthor();

        return $dbFields;
    }
}
