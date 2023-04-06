<?php declare(strict_types=1);

namespace tests\mock\Mapper\app;

use tests\mock\Model\app\AppData;
use Norm\ORM\Mapper\BaseMapper;
use Norm\ORM\Model\Model;

class AppDataMapper extends BaseMapper
{
    protected static string $tableName = 'apple_notify';
    protected string $modelName = AppData::class;

    public function getTableName(): string
    {
        return self::$tableName;
    }

    /**
     * @param Model|AppData $model
     * @param array $data
     * @return AppData
     */
    public function initModel(Model $model, array $data = []): AppData
    {
        $model->setId((int)($data['id'] ?? 0));
        $model->setData((string)($data['data'] ?? ''));
        $model->setCreateTime((string)($data['create_time'] ?? ''));

        return $model;
    }

    /**
     * @param Model|AppData $model
     * @return array
     */
    public function prepareSaveData(Model $model): array
    {
        $dbFields = ['id' => $model->getId()];
        $model->modelPropertyIsSet('id') && $dbFields['id'] = $model->getId();
        $model->modelPropertyIsSet('data') && $dbFields['data'] = $model->getData();
        $model->modelPropertyIsSet('createTime') && $dbFields['create_time'] = $model->getCreateTime();

        return $dbFields;
    }
}
