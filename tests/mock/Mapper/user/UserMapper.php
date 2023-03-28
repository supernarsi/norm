<?php declare(strict_types=1);

namespace tests\mock\Mapper\user;

use tests\mock\Model\user\User;
use Norm\ORM\Mapper\BaseMapper;
use Norm\ORM\Model\Model;

class UserMapper extends BaseMapper
{
    protected static string $baseTableName = 'tuser';
    protected string $modelName = User::class;

    public function getTableName(bool $isPartition, string $parIdx, bool $preMod = false): string
    {
        return $isPartition ? $this->getPartitionTableName($parIdx, $preMod) : self::$baseTableName;
    }

    /**
     * @param Model|User $model
     * @param array $data
     * @return User
     */
    public function initModel(Model $model, array $data = []): User
    {
        $model->setId((int)($data['id'] ?? 0));
        $model->setQq((string)($data['qq'] ?? ''));
        $model->setUsername((string)($data['username'] ?? ''));
        $model->setPicurl((string)($data['picurl'] ?? ''));
        $model->setNickname((string)($data['nickname'] ?? ''));
        $model->setStatus((int)($data['status'] ?? 0));
        $model->setIntegral((int)($data['integral'] ?? 0));
        $model->setTaskIntegral((int)($data['task_integral'] ?? 0));
        $model->setAggregate((int)($data['aggregate'] ?? 0));
        $model->setCreattime((int)($data['creattime'] ?? 0));
        $model->setUpdatetime((int)($data['updatetime'] ?? 0));
        $model->setFatherid((string)($data['fatherid'] ?? ''));
        $model->setSonIntegral((int)($data['son_integral'] ?? 0));
        $model->setIsvip((int)($data['isvip'] ?? 0));
        $model->setVipendtime((int)($data['vipendtime'] ?? 0));
        $model->setPlatform((int)($data['platform'] ?? 0));
        $model->setIsfollowWechat((int)($data['isfollow_wechat'] ?? 0));
        $model->setIsFirstPay((int)($data['is_first_pay'] ?? 0));
        $model->setIsPraise((int)($data['is_praise'] ?? 0));
        $model->setIdfa((string)($data['idfa'] ?? ''));
        $model->setMac((string)($data['mac'] ?? ''));
        $model->setImei((string)($data['imei'] ?? ''));
        $model->setSex((int)($data['sex'] ?? 0));
        $model->setIntro((string)($data['intro'] ?? ''));
        $model->setImgs((string)($data['imgs'] ?? ''));
        $model->setPhone((string)($data['phone'] ?? ''));
        $model->setOpenId((string)($data['open_id'] ?? ''));
        $model->setUuid((string)($data['uuid'] ?? ''));
        $model->setArea((string)($data['area'] ?? ''));
        $model->setBgimg((string)($data['bgimg'] ?? ''));
        $model->setBirthday((string)($data['birthday'] ?? ''));
        $model->setExperience((int)($data['experience'] ?? 0));
        $model->setOriginalTransactionId((string)($data['original_transaction_id'] ?? ''));
        $model->setLastLogin((int)($data['last_login'] ?? 0));
        $model->setHonorImg((string)($data['honor_img'] ?? ''));
        $model->setHonorType((int)($data['honor_type'] ?? 0));
        $model->setWxOpenid((string)($data['wx_openid'] ?? ''));
        $model->setImStatus((int)($data['im_status'] ?? 0));
        $model->setLoginVersion((string)($data['login_version'] ?? ''));
        $model->setRegisterVersion((string)($data['register_version'] ?? ''));
        $model->setImsetStatus((int)($data['imset_status'] ?? 0));
        $model->setRegisterIp((string)($data['register_ip'] ?? ''));

        return $model;
    }

    /**
     * @param Model|User $model
     * @return array
     */
    public function prepareSaveData(Model $model): array
    {
        $dbFields = ['id' => $model->getId()];
        $model->modelPropertyIsSet('id') && $dbFields['id'] = $model->getId();
        $model->modelPropertyIsSet('qq') && $dbFields['qq'] = $model->getQq();
        $model->modelPropertyIsSet('username') && $dbFields['username'] = $model->getUsername();
        $model->modelPropertyIsSet('picurl') && $dbFields['picurl'] = $model->getPicurl();
        $model->modelPropertyIsSet('nickname') && $dbFields['nickname'] = $model->getNickname();
        $model->modelPropertyIsSet('status') && $dbFields['status'] = $model->getStatus();
        $model->modelPropertyIsSet('integral') && $dbFields['integral'] = $model->getIntegral();
        $model->modelPropertyIsSet('taskIntegral') && $dbFields['task_integral'] = $model->getTaskIntegral();
        $model->modelPropertyIsSet('aggregate') && $dbFields['aggregate'] = $model->getAggregate();
        $model->modelPropertyIsSet('creattime') && $dbFields['creattime'] = $model->getCreattime();
        $model->modelPropertyIsSet('updatetime') && $dbFields['updatetime'] = $model->getUpdatetime();
        $model->modelPropertyIsSet('fatherid') && $dbFields['fatherid'] = $model->getFatherid();
        $model->modelPropertyIsSet('sonIntegral') && $dbFields['son_integral'] = $model->getSonIntegral();
        $model->modelPropertyIsSet('isvip') && $dbFields['isvip'] = $model->getIsvip();
        $model->modelPropertyIsSet('vipendtime') && $dbFields['vipendtime'] = $model->getVipendtime();
        $model->modelPropertyIsSet('platform') && $dbFields['platform'] = $model->getPlatform();
        $model->modelPropertyIsSet('isfollowWechat') && $dbFields['isfollow_wechat'] = $model->getIsfollowWechat();
        $model->modelPropertyIsSet('isFirstPay') && $dbFields['is_first_pay'] = $model->getIsFirstPay();
        $model->modelPropertyIsSet('isPraise') && $dbFields['is_praise'] = $model->getIsPraise();
        $model->modelPropertyIsSet('idfa') && $dbFields['idfa'] = $model->getIdfa();
        $model->modelPropertyIsSet('mac') && $dbFields['mac'] = $model->getMac();
        $model->modelPropertyIsSet('imei') && $dbFields['imei'] = $model->getImei();
        $model->modelPropertyIsSet('sex') && $dbFields['sex'] = $model->getSex();
        $model->modelPropertyIsSet('intro') && $dbFields['intro'] = $model->getIntro();
        $model->modelPropertyIsSet('imgs') && $dbFields['imgs'] = $model->getImgs();
        $model->modelPropertyIsSet('phone') && $dbFields['phone'] = $model->getPhone();
        $model->modelPropertyIsSet('openId') && $dbFields['open_id'] = $model->getOpenId();
        $model->modelPropertyIsSet('uuid') && $dbFields['uuid'] = $model->getUuid();
        $model->modelPropertyIsSet('area') && $dbFields['area'] = $model->getArea();
        $model->modelPropertyIsSet('bgimg') && $dbFields['bgimg'] = $model->getBgimg();
        $model->modelPropertyIsSet('birthday') && $dbFields['birthday'] = $model->getBirthday();
        $model->modelPropertyIsSet('experience') && $dbFields['experience'] = $model->getExperience();
        $model->modelPropertyIsSet('originalTransactionId') && $dbFields['original_transaction_id'] = $model->getOriginalTransactionId();
        $model->modelPropertyIsSet('lastLogin') && $dbFields['last_login'] = $model->getLastLogin();
        $model->modelPropertyIsSet('honorImg') && $dbFields['honor_img'] = $model->getHonorImg();
        $model->modelPropertyIsSet('honorType') && $dbFields['honor_type'] = $model->getHonorType();
        $model->modelPropertyIsSet('wxOpenid') && $dbFields['wx_openid'] = $model->getWxOpenid();
        $model->modelPropertyIsSet('imStatus') && $dbFields['im_status'] = $model->getImStatus();
        $model->modelPropertyIsSet('loginVersion') && $dbFields['login_version'] = $model->getLoginVersion();
        $model->modelPropertyIsSet('registerVersion') && $dbFields['register_version'] = $model->getRegisterVersion();
        $model->modelPropertyIsSet('imsetStatus') && $dbFields['imset_status'] = $model->getImsetStatus();
        $model->modelPropertyIsSet('registerIp') && $dbFields['register_ip'] = $model->getRegisterIp();

        return $dbFields;
    }
}
