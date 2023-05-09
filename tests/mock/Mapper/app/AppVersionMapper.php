<?php declare(strict_types=1);

namespace tests\mock\Mapper\app;

use tests\mock\Model\app\AppVersion;
use Norm\ORM\Mapper\BaseMapper;
use Norm\ORM\Model\Model;

class AppVersionMapper extends BaseMapper
{
    protected static string $tableName = 'app_version';
    protected string $modelName = AppVersion::class;

    public function getTableName(): string
    {
        return self::$tableName;
    }

    /**
     * @param Model|AppVersion $model
     * @param array $data
     * @return AppVersion
     */
    public function initModel(Model $model, array $data = []): AppVersion
    {
        $model->setId((int)($data['id'] ?? 0));
        $model->setVersion((string)($data['version'] ?? ''));
        $model->setIsLeast((int)($data['is_least'] ?? 0));
        $model->setApkUrl((string)($data['apk_url'] ?? ''));
        $model->setPlatform((int)($data['platform'] ?? 0));
        $model->setContent((string)($data['content'] ?? ''));
        $model->setReview((string)($data['review'] ?? ''));
        $model->setStatus((int)($data['status'] ?? 0));
        $model->setCreateTime((int)($data['create_time'] ?? 0));
        $model->setUpdateTime((int)($data['update_time'] ?? 0));

        return $model;
    }

    /**
     * @param Model|AppVersion $model
     * @return array
     */
    public function prepareSaveData(Model $model): array
    {
        $dbFields = ['id' => $model->getId()];
        $model->modelPropertyIsSet('id') && $dbFields['id'] = $model->getId();
        $model->modelPropertyIsSet('version') && $dbFields['version'] = $model->getVersion();
        $model->modelPropertyIsSet('isLeast') && $dbFields['is_least'] = $model->getIsLeast();
        $model->modelPropertyIsSet('apkUrl') && $dbFields['apk_url'] = $model->getApkUrl();
        $model->modelPropertyIsSet('platform') && $dbFields['platform'] = $model->getPlatform();
        $model->modelPropertyIsSet('content') && $dbFields['content'] = $model->getContent();
        $model->modelPropertyIsSet('review') && $dbFields['review'] = $model->getReview();
        $model->modelPropertyIsSet('status') && $dbFields['status'] = $model->getStatus();
        $model->modelPropertyIsSet('createTime') && $dbFields['create_time'] = $model->getCreateTime();
        $model->modelPropertyIsSet('updateTime') && $dbFields['update_time'] = $model->getUpdateTime();

        return $dbFields;
    }
}
