<?php declare(strict_types=1);

namespace tests\mock\Model\circle;

use Norm\ORM\Model\Model;

class Circle extends Model
{
    protected int $id = 0;
    protected int $cateId = 0;
    protected string $circleName = '';
    protected string $circleDesc = '';
    protected string $circleRule = '';
    protected string $circleColor = '';
    protected string $circleBg = '';
    protected string $circleLogo = '';
    protected string $adminNick = '';
    protected string $userNick = '';
    protected int $sort = 0;
    protected int $status = 0;
    protected int $memberNum = 0;
    protected int $hotNum = 0;
    protected int $level = 0;
    protected int $type = 0;
    protected int $isOfficial = 0;
    protected int $contributeOn = 0;
    protected int $createUser = 0;
    protected string $membersLevelNick = '';
    protected int $createTime = 0;
    protected int $updateTime = 0;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Circle
    {
        return $this->setProperty('id', $id);
    }

    public function getCateId(): int
    {
        return $this->cateId;
    }

    public function setCateId(int $cateId): Circle
    {
        return $this->setProperty('cateId', $cateId);
    }

    public function getCircleName(): string
    {
        return $this->circleName;
    }

    public function setCircleName(string $circleName): Circle
    {
        return $this->setProperty('circleName', $circleName);
    }

    public function getCircleDesc(): string
    {
        return $this->circleDesc;
    }

    public function setCircleDesc(string $circleDesc): Circle
    {
        return $this->setProperty('circleDesc', $circleDesc);
    }

    public function getCircleRule(): string
    {
        return $this->circleRule;
    }

    public function setCircleRule(string $circleRule): Circle
    {
        return $this->setProperty('circleRule', $circleRule);
    }

    public function getCircleColor(): string
    {
        return $this->circleColor;
    }

    public function setCircleColor(string $circleColor): Circle
    {
        return $this->setProperty('circleColor', $circleColor);
    }

    public function getCircleBg(): string
    {
        return $this->circleBg;
    }

    public function setCircleBg(string $circleBg): Circle
    {
        return $this->setProperty('circleBg', $circleBg);
    }

    public function getCircleLogo(): string
    {
        return $this->circleLogo;
    }

    public function setCircleLogo(string $circleLogo): Circle
    {
        return $this->setProperty('circleLogo', $circleLogo);
    }

    public function getAdminNick(): string
    {
        return $this->adminNick;
    }

    public function setAdminNick(string $adminNick): Circle
    {
        return $this->setProperty('adminNick', $adminNick);
    }

    public function getUserNick(): string
    {
        return $this->userNick;
    }

    public function setUserNick(string $userNick): Circle
    {
        return $this->setProperty('userNick', $userNick);
    }

    public function getSort(): int
    {
        return $this->sort;
    }

    public function setSort(int $sort): Circle
    {
        return $this->setProperty('sort', $sort);
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): Circle
    {
        return $this->setProperty('status', $status);
    }

    public function getMemberNum(): int
    {
        return $this->memberNum;
    }

    public function setMemberNum(int $memberNum): Circle
    {
        return $this->setProperty('memberNum', $memberNum);
    }

    public function getHotNum(): int
    {
        return $this->hotNum;
    }

    public function setHotNum(int $hotNum): Circle
    {
        return $this->setProperty('hotNum', $hotNum);
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function setLevel(int $level): Circle
    {
        return $this->setProperty('level', $level);
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function setType(int $type): Circle
    {
        return $this->setProperty('type', $type);
    }

    public function getIsOfficial(): int
    {
        return $this->isOfficial;
    }

    public function setIsOfficial(int $isOfficial): Circle
    {
        return $this->setProperty('isOfficial', $isOfficial);
    }

    public function getContributeOn(): int
    {
        return $this->contributeOn;
    }

    public function setContributeOn(int $contributeOn): Circle
    {
        return $this->setProperty('contributeOn', $contributeOn);
    }

    public function getCreateUser(): int
    {
        return $this->createUser;
    }

    public function setCreateUser(int $createUser): Circle
    {
        return $this->setProperty('createUser', $createUser);
    }

    public function getMembersLevelNick(): string
    {
        return $this->membersLevelNick;
    }

    public function setMembersLevelNick(string $membersLevelNick): Circle
    {
        return $this->setProperty('membersLevelNick', $membersLevelNick);
    }

    public function getCreateTime(): int
    {
        return $this->createTime;
    }

    public function setCreateTime(int $createTime): Circle
    {
        return $this->setProperty('createTime', $createTime);
    }

    public function getUpdateTime(): int
    {
        return $this->updateTime;
    }

    public function setUpdateTime(int $updateTime): Circle
    {
        return $this->setProperty('updateTime', $updateTime);
    }

    public function render(): array
    {
        return [
            'id' => $this->getId(),
            'cate_id' => $this->getCateId(),
            'circle_name' => $this->getCircleName(),
            'circle_desc' => $this->getCircleDesc(),
            'circle_rule' => $this->getCircleRule(),
            'circle_color' => $this->getCircleColor(),
            'circle_bg' => $this->getCircleBg(),
            'circle_logo' => $this->getCircleLogo(),
            'admin_nick' => $this->getAdminNick(),
            'user_nick' => $this->getUserNick(),
            'sort' => $this->getSort(),
            'status' => $this->getStatus(),
            'member_num' => $this->getMemberNum(),
            'hot_num' => $this->getHotNum(),
            'level' => $this->getLevel(),
            'type' => $this->getType(),
            'is_official' => $this->getIsOfficial(),
            'contribute_on' => $this->getContributeOn(),
            'create_user' => $this->getCreateUser(),
            'members_level_nick' => $this->getMembersLevelNick(),
            'create_time' => $this->getCreateTime(),
            'update_time' => $this->getUpdateTime(),
        ];
    }
}
