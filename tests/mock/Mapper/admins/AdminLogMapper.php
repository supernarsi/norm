<?php declare(strict_types=1);

namespace tests\mock\Mapper\admins;

use tests\mock\Model\admins\AdminLog;
use Norm\ORM\Mapper\BaseMapper;
use Norm\ORM\Model\Model;

class AdminLogMapper extends BaseMapper
{
    protected static string $tableName = 'admin_log';
    protected string $modelName = AdminLog::class;

    public function getTableName(): string
    {
        return self::$tableName;
    }

    /**
     * @param Model $model
     * @param array $data
     * @return AdminLog
     */
    public function initModel(Model $model, array $data = []): AdminLog
    {
        $model->setId((int)($data['id'] ?? 0));
        $model->setAdminId((int)($data['admin_id'] ?? 0));
        $model->setUsername((string)($data['username'] ?? ''));
        $model->setMessage((string)($data['message'] ?? ''));
        $model->setUrl((string)($data['url'] ?? ''));
        $model->setAddtime((int)($data['addtime'] ?? 0));
        $model->setProject((int)($data['project'] ?? 0));

        return $model;
    }

    /**
     * @param Model $model
     * @return array
     */
    public function prepareSaveData(Model $model): array
    {
        $dbFields = ['id' => $model->getId()];
        $model->modelPropertyIsSet('id') && $dbFields['id'] = $model->getId();
        $model->modelPropertyIsSet('adminId') && $dbFields['admin_id'] = $model->getAdminId();
        $model->modelPropertyIsSet('username') && $dbFields['username'] = $model->getUsername();
        $model->modelPropertyIsSet('message') && $dbFields['message'] = $model->getMessage();
        $model->modelPropertyIsSet('url') && $dbFields['url'] = $model->getUrl();
        $model->modelPropertyIsSet('addtime') && $dbFields['addtime'] = $model->getAddtime();
        $model->modelPropertyIsSet('project') && $dbFields['project'] = $model->getProject();

        return $dbFields;
    }
}
