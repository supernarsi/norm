<?php declare(strict_types=1);

namespace tests\mock\Mapper\admins;

use tests\mock\Model\admins\Admins;
use Norm\ORM\Mapper\BaseMapper;
use Norm\ORM\Model\Model;

class AdminsMapper extends BaseMapper
{
    protected static string $tableName = 'admins';
    protected string $modelName = Admins::class;

    public function getTableName(): string
    {
        return self::$tableName;
    }

    /**
     * @param Model|Admins $model
     * @param array $data
     * @return Admins
     */
    public function initModel(Model $model, array $data = []): Admins
    {
        $model->setId((int)($data['id'] ?? 0));
        $model->setUsername((string)($data['username'] ?? ''));
        $model->setPassword((string)($data['password'] ?? ''));
        $model->setAvatar((string)($data['avatar'] ?? ''));
        $model->setEmail((string)($data['email'] ?? ''));
        $model->setStatus((int)($data['status'] ?? 0));
        $model->setRole((int)($data['role'] ?? 0));
        $model->setRoleId((int)($data['role_id'] ?? 0));
        $model->setCtime((int)($data['ctime'] ?? 0));
        $model->setMtime((int)($data['mtime'] ?? 0));

        return $model;
    }

    /**
     * @param Model|Admins $model
     * @return array
     */
    public function prepareSaveData(Model $model): array
    {
        $dbFields = ['id' => $model->getId()];
        $model->modelPropertyIsSet('id') && $dbFields['id'] = $model->getId();
        $model->modelPropertyIsSet('username') && $dbFields['username'] = $model->getUsername();
        $model->modelPropertyIsSet('password') && $dbFields['password'] = $model->getPassword();
        $model->modelPropertyIsSet('avatar') && $dbFields['avatar'] = $model->getAvatar();
        $model->modelPropertyIsSet('email') && $dbFields['email'] = $model->getEmail();
        $model->modelPropertyIsSet('status') && $dbFields['status'] = $model->getStatus();
        $model->modelPropertyIsSet('role') && $dbFields['role'] = $model->getRole();
        $model->modelPropertyIsSet('roleId') && $dbFields['role_id'] = $model->getRoleId();
        $model->modelPropertyIsSet('ctime') && $dbFields['ctime'] = $model->getCtime();
        $model->modelPropertyIsSet('mtime') && $dbFields['mtime'] = $model->getMtime();

        return $dbFields;
    }
}
