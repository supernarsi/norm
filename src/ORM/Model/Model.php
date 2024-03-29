<?php declare(strict_types=1);

namespace Norm\ORM\Model;

use Norm\DB\DQuery;
use Norm\DB\IStorage;
use Norm\ORM\Mapper\Mapper;

/**
 * Class Model
 *
 * @package Norm\ORM
 */
abstract class Model
{
    /** @var array 对象中被 set 过的属性 */
    protected array $beSetProperties = [];
    protected ?Mapper $mapper;

    /** need implements */
    abstract public function getId(): int;

    public function modelPropertyIsSet(string $field): bool
    {
        return ($this->beSetProperties[$field] ?? false) === true;
    }

    public function getModelProperties(): array
    {
        return $this->beSetProperties;
    }

    public function getMapper(): ?Mapper
    {
        return $this->mapper;
    }

    protected function initORM(array $initData = []): ?self
    {
        return $this->mapper ? $this->mapper->initModel($this, $initData) : null;
    }

    /**
     * Model constructor.
     *
     * @param array $data
     * @param Mapper|null $mapper
     * @param bool $unsetProperty 是否需要将所有字段标为未 set
     */
    public function __construct(array $data = [], ?Mapper $mapper = null, bool $unsetProperty = true)
    {
        // 将类的属性赋值给 properties
        $this->beSetProperties = get_object_vars($this);
        $this->mapper = $mapper;
        $this->initORM($data);

        if ($unsetProperty) {
            // 初始时，所有字段设为未 set
            foreach ($this->beSetProperties as &$isSet) {
                $isSet = false;
            }
        }
    }

    /**
     * @param string $field
     * @param mixed $val
     * @return $this
     */
    public function setProperty(string $field, $val): self
    {
        isset($this->beSetProperties[$field]) && ($this->beSetProperties[$field] = true);
        $this->$field = $val;
        return $this;
    }

    /**
     * @param array $fields
     * @return array
     */
    public function getModelFields(array $fields = []): array
    {
        return $fields ?: ($this->mapper ? $this->mapper->prepareSaveData($this) : []);
    }

    public function insert(IStorage $db): ?self
    {
        if (!$this->mapper) {
            return null;
        }
        $id = $this->mapper->insert($db, $this->getModelFields());
        if (!$id) {
            return null;
        }
        return $this->setProperty('id', $id);
    }

    public function update(IStorage $db): ?self
    {
        if (!$this->mapper) {
            return null;
        }
        $res = $this->mapper->update($db, $this->getModelFields());
        return $res ? $this : null;
    }

    public function save(IStorage $db): ?self
    {
        return $this->getId() > 0 ? $this->update($db) : $this->insert($db);
    }

    public function delete(IStorage $db): bool
    {
        $id = $this->getId();
        return $id > 0 && $this->mapper->delete($db, (new DQuery())->where('id', '=', $id));
    }

    public function render(): array
    {
        return [];
    }
}
