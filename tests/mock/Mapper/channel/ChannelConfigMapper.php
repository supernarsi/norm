<?php declare(strict_types=1);

namespace tests\mock\Mapper\channel;

use tests\mock\Model\channel\ChannelConfig;
use Norm\ORM\Mapper\BaseMapper;
use Norm\ORM\Model\Model;

class ChannelConfigMapper extends BaseMapper
{
    protected static string $tableName = 'channel_config';
    protected string $modelName = ChannelConfig::class;

    public function getTableName(): string
    {
        return self::$tableName;
    }

    /**
     * @param Model|ChannelConfig $model
     * @param array $data
     * @return ChannelConfig
     */
    public function initModel(Model $model, array $data = []): ChannelConfig
    {
        $model->setId((int)($data['id'] ?? 0));
        $model->setPlatform((int)($data['platform'] ?? 0));
        $model->setChannelName((string)($data['channel_name'] ?? ''));
        $model->setType((int)($data['type'] ?? 0));
        $model->setAdSubType((int)($data['ad_sub_type'] ?? 0));
        $model->setBindPhone((bool)($data['bind_phone'] ?? false));
        $model->setAlias((string)($data['alias'] ?? ''));
        $model->setCreateTime((string)($data['create_time'] ?? ''));
        $model->setUpdateTime((string)($data['update_time'] ?? ''));

        return $model;
    }

    /**
     * @param Model|ChannelConfig $model
     * @return array
     */
    public function prepareSaveData(Model $model): array
    {
        $dbFields = ['id' => $model->getId()];
        $model->modelPropertyIsSet('id') && $dbFields['id'] = $model->getId();
        $model->modelPropertyIsSet('platform') && $dbFields['platform'] = $model->getPlatform();
        $model->modelPropertyIsSet('channelName') && $dbFields['channel_name'] = $model->getChannelName();
        $model->modelPropertyIsSet('type') && $dbFields['type'] = $model->getType();
        $model->modelPropertyIsSet('adSubType') && $dbFields['ad_sub_type'] = $model->getAdSubType();
        $model->modelPropertyIsSet('bindPhone') && $dbFields['bind_phone'] = $model->getBindPhone();
        $model->modelPropertyIsSet('alias') && $dbFields['alias'] = $model->getAlias();
        $model->modelPropertyIsSet('createTime') && $dbFields['create_time'] = $model->getCreateTime();
        $model->modelPropertyIsSet('updateTime') && $dbFields['update_time'] = $model->getUpdateTime();

        return $dbFields;
    }
}
