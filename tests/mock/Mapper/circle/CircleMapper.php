<?php declare(strict_types=1);

namespace tests\mock\Mapper\circle;

use Norm\ORM\Mapper\BasePartitionMapper;
use tests\mock\Model\circle\Circle;
use Norm\ORM\Model\Model;

class CircleMapper extends BasePartitionMapper
{
    protected static string $baseTableName = 'circle';
    protected string $modelName = Circle::class;

    public function getTableName(bool $isPartition = false, string $parIdx = '', bool $preMod = false): string
    {
        return $isPartition ? $this->getPartitionTableName($parIdx, $preMod) : self::$baseTableName;
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
        $model->setCircleRule((string)($data['circle_rule'] ?? ''));
        $model->setCircleColor((string)($data['circle_color'] ?? ''));
        $model->setCircleBg((string)($data['circle_bg'] ?? ''));
        $model->setCircleLogo((string)($data['circle_logo'] ?? ''));
        $model->setAdminNick((string)($data['admin_nick'] ?? ''));
        $model->setUserNick((string)($data['user_nick'] ?? ''));
        $model->setSort((int)($data['sort'] ?? 0));
        $model->setStatus((int)($data['status'] ?? 0));
        $model->setMemberNum((int)($data['member_num'] ?? 0));
        $model->setHotNum((int)($data['hot_num'] ?? 0));
        $model->setLevel((int)($data['level'] ?? 0));
        $model->setType((int)($data['type'] ?? 0));
        $model->setIsOfficial((int)($data['is_official'] ?? 0));
        $model->setContributeOn((int)($data['contribute_on'] ?? 0));
        $model->setCreateUser((int)($data['create_user'] ?? 0));
        $model->setMembersLevelNick((string)($data['members_level_nick'] ?? ''));
        $model->setCreateTime((int)($data['create_time'] ?? 0));
        $model->setUpdateTime((int)($data['update_time'] ?? 0));

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
        $model->modelPropertyIsSet('circleRule') && $dbFields['circle_rule'] = $model->getCircleRule();
        $model->modelPropertyIsSet('circleColor') && $dbFields['circle_color'] = $model->getCircleColor();
        $model->modelPropertyIsSet('circleBg') && $dbFields['circle_bg'] = $model->getCircleBg();
        $model->modelPropertyIsSet('circleLogo') && $dbFields['circle_logo'] = $model->getCircleLogo();
        $model->modelPropertyIsSet('adminNick') && $dbFields['admin_nick'] = $model->getAdminNick();
        $model->modelPropertyIsSet('userNick') && $dbFields['user_nick'] = $model->getUserNick();
        $model->modelPropertyIsSet('sort') && $dbFields['sort'] = $model->getSort();
        $model->modelPropertyIsSet('status') && $dbFields['status'] = $model->getStatus();
        $model->modelPropertyIsSet('memberNum') && $dbFields['member_num'] = $model->getMemberNum();
        $model->modelPropertyIsSet('hotNum') && $dbFields['hot_num'] = $model->getHotNum();
        $model->modelPropertyIsSet('level') && $dbFields['level'] = $model->getLevel();
        $model->modelPropertyIsSet('type') && $dbFields['type'] = $model->getType();
        $model->modelPropertyIsSet('isOfficial') && $dbFields['is_official'] = $model->getIsOfficial();
        $model->modelPropertyIsSet('contributeOn') && $dbFields['contribute_on'] = $model->getContributeOn();
        $model->modelPropertyIsSet('createUser') && $dbFields['create_user'] = $model->getCreateUser();
        $model->modelPropertyIsSet('membersLevelNick') && $dbFields['members_level_nick'] = $model->getMembersLevelNick();
        $model->modelPropertyIsSet('createTime') && $dbFields['create_time'] = $model->getCreateTime();
        $model->modelPropertyIsSet('updateTime') && $dbFields['update_time'] = $model->getUpdateTime();

        return $dbFields;
    }
}
