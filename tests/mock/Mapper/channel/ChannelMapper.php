<?php declare(strict_types=1);

namespace tests\mock\Mapper\Channel;

use tests\mock\Model\Channel\Channel;
use Norm\ORM\Mapper\BaseMapper;
use Norm\ORM\Model\Model;

class ChannelMapper extends BaseMapper
{
    protected static string $tableName = 'channel';
    protected string $modelName = Channel::class;

    public function getTableName(): string
    {
        return self::$tableName;
    }

    /**
     * @param Model|Channel $model
     * @param array $data
     * @return Channel
     */
    public function initModel(Model $model, array $data = []): Channel
    {
        $model->setId((int)($data['id'] ?? 0));
        $model->setTitle((string)($data['title'] ?? ''));
        $model->setAlias((string)($data['alias'] ?? ''));

        return $model;
    }

    /**
     * @param Model|Channel $model
     * @return array
     */
    public function prepareSaveData(Model $model): array
    {
        $dbFields = ['id' => $model->getId()];
        $model->modelPropertyIsSet('id') && $dbFields['id'] = $model->getId();
        $model->modelPropertyIsSet('title') && $dbFields['title'] = $model->getTitle();
        $model->modelPropertyIsSet('alias') && $dbFields['alias'] = $model->getAlias();

        return $dbFields;
    }
}
