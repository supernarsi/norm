<?php declare(strict_types=1);

namespace tests\mock;

use Norm\ORM\Mapper\BaseMapper;
use Norm\ORM\Model\Model;

class UserMapper extends BaseMapper
{
    protected static string $tableName = 'user';
    protected string $modelName = User::class;

    public function getTableName(): string
    {
        return self::$tableName;
    }

    public function prepareSaveData(Model $model): array
    {
        $dbFields = ['id' => $model->getId()];
        $model->modelPropertyIsSet('id') && $dbFields['id'] = $model->getId();
        $model->modelPropertyIsSet('nick') && $dbFields['nick'] = $model->getNick();
        return $dbFields;
    }

    public function initModel(Model $model, array $data = []): User
    {
        $model->setId((int)($data['id'] ?? 0));
        $model->setNick((string)($data['nick'] ?? ''));
        return $model;
    }
}
