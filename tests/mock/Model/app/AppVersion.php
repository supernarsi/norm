<?php declare(strict_types=1);

namespace tests\mock\Model\app;

use Norm\ORM\Model\Model;

class AppVersion extends Model
{
    protected int $id = 0;
    protected string $version = '';
    protected int $isLeast = 0;
    protected string $apkUrl = '';
    protected int $platform = 0;
    protected string $content = '';
    protected string $review = '';
    protected int $status = 0;
    protected int $createTime = 0;
    protected int $updateTime = 0;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): AppVersion
    {
        return $this->setProperty('id', $id);
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): AppVersion
    {
        return $this->setProperty('version', $version);
    }

    public function getIsLeast(): int
    {
        return $this->isLeast;
    }

    public function setIsLeast(int $isLeast): AppVersion
    {
        return $this->setProperty('isLeast', $isLeast);
    }

    public function getApkUrl(): string
    {
        return $this->apkUrl;
    }

    public function setApkUrl(string $apkUrl): AppVersion
    {
        return $this->setProperty('apkUrl', $apkUrl);
    }

    public function getPlatform(): int
    {
        return $this->platform;
    }

    public function setPlatform(int $platform): AppVersion
    {
        return $this->setProperty('platform', $platform);
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): AppVersion
    {
        return $this->setProperty('content', $content);
    }

    public function getReview(): string
    {
        return $this->review;
    }

    public function setReview(string $review): AppVersion
    {
        return $this->setProperty('review', $review);
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): AppVersion
    {
        return $this->setProperty('status', $status);
    }

    public function getCreateTime(): int
    {
        return $this->createTime;
    }

    public function setCreateTime(int $createTime): AppVersion
    {
        return $this->setProperty('createTime', $createTime);
    }

    public function getUpdateTime(): int
    {
        return $this->updateTime;
    }

    public function setUpdateTime(int $updateTime): AppVersion
    {
        return $this->setProperty('updateTime', $updateTime);
    }

    public function render(): array
    {
        return [
            'id' => $this->getId(),
            'version' => $this->getVersion(),
            'is_least' => $this->getIsLeast(),
            'apk_url' => $this->getApkUrl(),
            'platform' => $this->getPlatform(),
            'content' => $this->getContent(),
            'review' => $this->getReview(),
            'status' => $this->getStatus(),
            'create_time' => $this->getCreateTime(),
            'update_time' => $this->getUpdateTime(),
        ];
    }
}
