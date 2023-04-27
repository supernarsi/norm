<?php declare(strict_types=1);

namespace tests\mock\Model\admins;

use Norm\ORM\Model\Model;

class AdminLog extends Model
{
    protected int $id = 0;
    protected int $adminId = 0;
    protected string $username = '';
    protected string $message = '';
    protected string $url = '';
    protected int $addtime = 0;
    protected int $project = 0;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): AdminLog
    {
        return $this->setProperty('id', $id);
    }

    public function getAdminId(): int
    {
        return $this->adminId;
    }

    public function setAdminId(int $adminId): AdminLog
    {
        return $this->setProperty('adminId', $adminId);
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): AdminLog
    {
        return $this->setProperty('username', $username);
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): AdminLog
    {
        return $this->setProperty('message', $message);
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): AdminLog
    {
        return $this->setProperty('url', $url);
    }

    public function getAddtime(): int
    {
        return $this->addtime;
    }

    public function setAddtime(int $addtime): AdminLog
    {
        return $this->setProperty('addtime', $addtime);
    }

    public function getProject(): int
    {
        return $this->project;
    }

    public function setProject(int $project): AdminLog
    {
        return $this->setProperty('project', $project);
    }

    public function render(): array
    {
        return [
            'id' => $this->getId(),
            'admin_id' => $this->getAdminId(),
            'username' => $this->getUsername(),
            'message' => $this->getMessage(),
            'url' => $this->getUrl(),
            'addtime' => $this->getAddtime(),
            'project' => $this->getProject(),
        ];
    }
}
