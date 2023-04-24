<?php declare(strict_types=1);

namespace tests\mock\Mapper\admins;

use tests\mock\Model\admins\AdminRole;
use Norm\ORM\Mapper\BaseMapper;
use Norm\ORM\Model\Model;

class AdminRoleMapper extends BaseMapper
{
    protected static string $tableName = 'admin_roles';
    protected string $modelName = AdminRole::class;

    public function getTableName(): string
    {
        return self::$tableName;
    }

    /**
     * @param Model|AdminRole $model
     * @param array $data
     * @return AdminRole
     */
    public function initModel(Model $model, array $data = []): AdminRole
    {
        $model->setId((int)($data['id'] ?? 0));
        $model->setName((string)($data['name'] ?? ''));
        $model->setCtime((int)($data['ctime'] ?? 0));
        $model->setMtime((int)($data['mtime'] ?? 0));
        $model->setStatus((int)($data['status'] ?? 0));

        return $model;
    }

    /**
     * @param Model|AdminRole $model
     * @return array
     */
    public function prepareSaveData(Model $model): array
    {
        $dbFields = ['id' => $model->getId()];
        $model->modelPropertyIsSet('id') && $dbFields['id'] = $model->getId();
        $model->modelPropertyIsSet('name') && $dbFields['name'] = $model->getName();
        $model->modelPropertyIsSet('ctime') && $dbFields['ctime'] = $model->getCtime();
        $model->modelPropertyIsSet('mtime') && $dbFields['mtime'] = $model->getMtime();
        $model->modelPropertyIsSet('status') && $dbFields['status'] = $model->getStatus();

        return $dbFields;
    }
}
