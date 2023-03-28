<?php declare(strict_types=1);

namespace tests\mock\Model\user;

use Norm\ORM\Model\Model;

class User extends Model
{
    protected int $id = 0;
    protected string $qq = '';
    protected string $username = '';
    protected string $picurl = '';
    protected string $nickname = '';
    protected int $status = 0;
    protected int $integral = 0;
    protected int $taskIntegral = 0;
    protected int $aggregate = 0;
    protected int $creattime = 0;
    protected int $updatetime = 0;
    protected string $fatherid = '';
    protected int $sonIntegral = 0;
    protected int $isvip = 0;
    protected int $vipendtime = 0;
    protected int $platform = 0;
    protected int $isfollowWechat = 0;
    protected int $isFirstPay = 0;
    protected int $isPraise = 0;
    protected string $idfa = '';
    protected string $mac = '';
    protected string $imei = '';
    protected int $sex = 0;
    protected string $intro = '';
    protected string $imgs = '';
    protected string $phone = '';
    protected string $openId = '';
    protected string $uuid = '';
    protected string $area = '';
    protected string $bgimg = '';
    protected string $birthday = '';
    protected int $experience = 0;
    protected string $originalTransactionId = '';
    protected int $lastLogin = 0;
    protected string $honorImg = '';
    protected int $honorType = 0;
    protected string $wxOpenid = '';
    protected int $imStatus = 0;
    protected string $loginVersion = '';
    protected string $registerVersion = '';
    protected int $imsetStatus = 0;
    protected string $registerIp = '';

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): User
    {
        return $this->setProperty('id', $id);
    }

    public function getQq(): string
    {
        return $this->qq;
    }

    public function setQq(string $qq): User
    {
        return $this->setProperty('qq', $qq);
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): User
    {
        return $this->setProperty('username', $username);
    }

    public function getPicurl(): string
    {
        return $this->picurl;
    }

    public function setPicurl(string $picurl): User
    {
        return $this->setProperty('picurl', $picurl);
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): User
    {
        return $this->setProperty('nickname', $nickname);
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): User
    {
        return $this->setProperty('status', $status);
    }

    public function getIntegral(): int
    {
        return $this->integral;
    }

    public function setIntegral(int $integral): User
    {
        return $this->setProperty('integral', $integral);
    }

    public function getTaskIntegral(): int
    {
        return $this->taskIntegral;
    }

    public function setTaskIntegral(int $taskIntegral): User
    {
        return $this->setProperty('taskIntegral', $taskIntegral);
    }

    public function getAggregate(): int
    {
        return $this->aggregate;
    }

    public function setAggregate(int $aggregate): User
    {
        return $this->setProperty('aggregate', $aggregate);
    }

    public function getCreattime(): int
    {
        return $this->creattime;
    }

    public function setCreattime(int $creattime): User
    {
        return $this->setProperty('creattime', $creattime);
    }

    public function getUpdatetime(): int
    {
        return $this->updatetime;
    }

    public function setUpdatetime(int $updatetime): User
    {
        return $this->setProperty('updatetime', $updatetime);
    }

    public function getFatherid(): string
    {
        return $this->fatherid;
    }

    public function setFatherid(string $fatherid): User
    {
        return $this->setProperty('fatherid', $fatherid);
    }

    public function getSonIntegral(): int
    {
        return $this->sonIntegral;
    }

    public function setSonIntegral(int $sonIntegral): User
    {
        return $this->setProperty('sonIntegral', $sonIntegral);
    }

    public function getIsvip(): int
    {
        return $this->isvip;
    }

    public function setIsvip(int $isvip): User
    {
        return $this->setProperty('isvip', $isvip);
    }

    public function getVipendtime(): int
    {
        return $this->vipendtime;
    }

    public function setVipendtime(int $vipendtime): User
    {
        return $this->setProperty('vipendtime', $vipendtime);
    }

    public function getPlatform(): int
    {
        return $this->platform;
    }

    public function setPlatform(int $platform): User
    {
        return $this->setProperty('platform', $platform);
    }

    public function getIsfollowWechat(): int
    {
        return $this->isfollowWechat;
    }

    public function setIsfollowWechat(int $isfollowWechat): User
    {
        return $this->setProperty('isfollowWechat', $isfollowWechat);
    }

    public function getIsFirstPay(): int
    {
        return $this->isFirstPay;
    }

    public function setIsFirstPay(int $isFirstPay): User
    {
        return $this->setProperty('isFirstPay', $isFirstPay);
    }

    public function getIsPraise(): int
    {
        return $this->isPraise;
    }

    public function setIsPraise(int $isPraise): User
    {
        return $this->setProperty('isPraise', $isPraise);
    }

    public function getIdfa(): string
    {
        return $this->idfa;
    }

    public function setIdfa(string $idfa): User
    {
        return $this->setProperty('idfa', $idfa);
    }

    public function getMac(): string
    {
        return $this->mac;
    }

    public function setMac(string $mac): User
    {
        return $this->setProperty('mac', $mac);
    }

    public function getImei(): string
    {
        return $this->imei;
    }

    public function setImei(string $imei): User
    {
        return $this->setProperty('imei', $imei);
    }

    public function getSex(): int
    {
        return $this->sex;
    }

    public function setSex(int $sex): User
    {
        return $this->setProperty('sex', $sex);
    }

    public function getIntro(): string
    {
        return $this->intro;
    }

    public function setIntro(string $intro): User
    {
        return $this->setProperty('intro', $intro);
    }

    public function getImgs(): string
    {
        return $this->imgs;
    }

    public function setImgs(string $imgs): User
    {
        return $this->setProperty('imgs', $imgs);
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): User
    {
        return $this->setProperty('phone', $phone);
    }

    public function getOpenId(): string
    {
        return $this->openId;
    }

    public function setOpenId(string $openId): User
    {
        return $this->setProperty('openId', $openId);
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): User
    {
        return $this->setProperty('uuid', $uuid);
    }

    public function getArea(): string
    {
        return $this->area;
    }

    public function setArea(string $area): User
    {
        return $this->setProperty('area', $area);
    }

    public function getBgimg(): string
    {
        return $this->bgimg;
    }

    public function setBgimg(string $bgimg): User
    {
        return $this->setProperty('bgimg', $bgimg);
    }

    public function getBirthday(): string
    {
        return $this->birthday;
    }

    public function setBirthday(string $birthday): User
    {
        return $this->setProperty('birthday', $birthday);
    }

    public function getExperience(): int
    {
        return $this->experience;
    }

    public function setExperience(int $experience): User
    {
        return $this->setProperty('experience', $experience);
    }

    public function getOriginalTransactionId(): string
    {
        return $this->originalTransactionId;
    }

    public function setOriginalTransactionId(string $originalTransactionId): User
    {
        return $this->setProperty('originalTransactionId', $originalTransactionId);
    }

    public function getLastLogin(): int
    {
        return $this->lastLogin;
    }

    public function setLastLogin(int $lastLogin): User
    {
        return $this->setProperty('lastLogin', $lastLogin);
    }

    public function getHonorImg(): string
    {
        return $this->honorImg;
    }

    public function setHonorImg(string $honorImg): User
    {
        return $this->setProperty('honorImg', $honorImg);
    }

    public function getHonorType(): int
    {
        return $this->honorType;
    }

    public function setHonorType(int $honorType): User
    {
        return $this->setProperty('honorType', $honorType);
    }

    public function getWxOpenid(): string
    {
        return $this->wxOpenid;
    }

    public function setWxOpenid(string $wxOpenid): User
    {
        return $this->setProperty('wxOpenid', $wxOpenid);
    }

    public function getImStatus(): int
    {
        return $this->imStatus;
    }

    public function setImStatus(int $imStatus): User
    {
        return $this->setProperty('imStatus', $imStatus);
    }

    public function getLoginVersion(): string
    {
        return $this->loginVersion;
    }

    public function setLoginVersion(string $loginVersion): User
    {
        return $this->setProperty('loginVersion', $loginVersion);
    }

    public function getRegisterVersion(): string
    {
        return $this->registerVersion;
    }

    public function setRegisterVersion(string $registerVersion): User
    {
        return $this->setProperty('registerVersion', $registerVersion);
    }

    public function getImsetStatus(): int
    {
        return $this->imsetStatus;
    }

    public function setImsetStatus(int $imsetStatus): User
    {
        return $this->setProperty('imsetStatus', $imsetStatus);
    }

    public function getRegisterIp(): string
    {
        return $this->registerIp;
    }

    public function setRegisterIp(string $registerIp): User
    {
        return $this->setProperty('registerIp', $registerIp);
    }

    public function render(): array
    {
        return [
            'id' => $this->getId(),
            'qq' => $this->getQq(),
            'username' => $this->getUsername(),
            'picurl' => $this->getPicurl(),
            'nickname' => $this->getNickname(),
            'status' => $this->getStatus(),
            'integral' => $this->getIntegral(),
            'task_integral' => $this->getTaskIntegral(),
            'aggregate' => $this->getAggregate(),
            'creattime' => $this->getCreattime(),
            'updatetime' => $this->getUpdatetime(),
            'fatherid' => $this->getFatherid(),
            'son_integral' => $this->getSonIntegral(),
            'isvip' => $this->getIsvip(),
            'vipendtime' => $this->getVipendtime(),
            'platform' => $this->getPlatform(),
            'isfollow_wechat' => $this->getIsfollowWechat(),
            'is_first_pay' => $this->getIsFirstPay(),
            'is_praise' => $this->getIsPraise(),
            'idfa' => $this->getIdfa(),
            'mac' => $this->getMac(),
            'imei' => $this->getImei(),
            'sex' => $this->getSex(),
            'intro' => $this->getIntro(),
            'imgs' => $this->getImgs(),
            'phone' => $this->getPhone(),
            'open_id' => $this->getOpenId(),
            'uuid' => $this->getUuid(),
            'area' => $this->getArea(),
            'bgimg' => $this->getBgimg(),
            'birthday' => $this->getBirthday(),
            'experience' => $this->getExperience(),
            'original_transaction_id' => $this->getOriginalTransactionId(),
            'last_login' => $this->getLastLogin(),
            'honor_img' => $this->getHonorImg(),
            'honor_type' => $this->getHonorType(),
            'wx_openid' => $this->getWxOpenid(),
            'im_status' => $this->getImStatus(),
            'login_version' => $this->getLoginVersion(),
            'register_version' => $this->getRegisterVersion(),
            'imset_status' => $this->getImsetStatus(),
            'register_ip' => $this->getRegisterIp(),
        ];
    }
}
