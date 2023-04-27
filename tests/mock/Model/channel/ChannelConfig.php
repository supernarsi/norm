<?php declare(strict_types=1);

namespace tests\mock\Model\channel;

use Norm\ORM\Model\Model;

class ChannelConfig extends Model
{
    protected int $id = 0;
    protected int $platform = 0;
    protected string $channelName = '';
    protected int $type = 0;
    protected int $adSubType = 0;
    protected bool $bindPhone = false;
    protected string $alias = '';
    protected string $createTime = '';
    protected string $updateTime = '';

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): ChannelConfig
    {
        return $this->setProperty('id', $id);
    }

    public function getPlatform(): int
    {
        return $this->platform;
    }

    public function setPlatform(int $platform): ChannelConfig
    {
        return $this->setProperty('platform', $platform);
    }

    public function getChannelName(): string
    {
        return $this->channelName;
    }

    public function setChannelName(string $channelName): ChannelConfig
    {
        return $this->setProperty('channelName', $channelName);
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function setType(int $type): ChannelConfig
    {
        return $this->setProperty('type', $type);
    }

    public function getAdSubType(): int
    {
        return $this->adSubType;
    }

    public function setAdSubType(int $adSubType): ChannelConfig
    {
        return $this->setProperty('adSubType', $adSubType);
    }

    public function getBindPhone(): bool
    {
        return $this->bindPhone;
    }

    public function setBindPhone(bool $bindPhone): ChannelConfig
    {
        return $this->setProperty('bindPhone', $bindPhone);
    }

    public function getAlias(): string
    {
        return $this->alias;
    }

    public function setAlias(string $alias): ChannelConfig
    {
        return $this->setProperty('alias', $alias);
    }

    public function getCreateTime(): string
    {
        return $this->createTime;
    }

    public function setCreateTime(string $createTime): ChannelConfig
    {
        return $this->setProperty('createTime', $createTime);
    }

    public function getUpdateTime(): string
    {
        return $this->updateTime;
    }

    public function setUpdateTime(string $updateTime): ChannelConfig
    {
        return $this->setProperty('updateTime', $updateTime);
    }

    public function render(): array
    {
        return [
            'id' => $this->getId(),
            'platform' => $this->getPlatform(),
            'channel_name' => $this->getChannelName(),
            'type' => $this->getType(),
            'ad_sub_type' => $this->getAdSubType(),
            'bind_phone' => $this->getBindPhone(),
            'alias' => $this->getAlias(),
            'create_time' => $this->getCreateTime(),
            'update_time' => $this->getUpdateTime(),
        ];
    }
}
