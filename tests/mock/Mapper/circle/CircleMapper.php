<?php declare(strict_types=1);

namespace tests\mock\Mapper\circle;

use tests\mock\Model\circle\Circle;
use Norm\ORM\Mapper\BaseMapper;
use Norm\ORM\Model\Model;

class CircleMapper extends BaseMapper
{
    protected static string $tableName = 'circle';
    protected string $modelName = Circle::class;

    public function getTableName(): string
    {
        return self::$tableName;
    }

    /**
     * @param Model|Circle $model
     * @param array $data
     * @return Circle
     */
    public function initModel(Model $model, array $data = []): Circle
    {
        $model->setId((int)($data['id'] ?? 0));
        $model->setCateId((int)($data['cate_id'] ?? 0));
        $model->setCircleName((string)($data['circle_name'] ?? ''));
        $model->setCircleDesc((string)($data['circle_desc'] ?? ''));
        $model->setSort((int)($data['sort'] ?? 0));
        $model->setStatus((int)($data['status'] ?? 0));
        $model->setLevel((int)($data['level'] ?? 0));
        $model->setType((int)($data['type'] ?? 0));

        return $model;
    }

    /**
     * @param Model|Circle $model
     * @return array
     */
    public function prepareSaveData(Model $model): array
    {
        $dbFields = ['id' => $model->getId()];
        $model->modelPropertyIsSet('id') && $dbFields['id'] = $model->getId();
        $model->modelPropertyIsSet('cateId') && $dbFields['cate_id'] = $model->getCateId();
        $model->modelPropertyIsSet('circleName') && $dbFields['circle_name'] = $model->getCircleName();
        $model->modelPropertyIsSet('circleDesc') && $dbFields['circle_desc'] = $model->getCircleDesc();
        $model->modelPropertyIsSet('sort') && $dbFields['sort'] = $model->getSort();
        $model->modelPropertyIsSet('status') && $dbFields['status'] = $model->getStatus();
        $model->modelPropertyIsSet('level') && $dbFields['level'] = $model->getLevel();
        $model->modelPropertyIsSet('type') && $dbFields['type'] = $model->getType();

        return $dbFields;
    }
}
