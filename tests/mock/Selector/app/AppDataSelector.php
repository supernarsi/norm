<?php declare(strict_types=1);

namespace tests\mock\Selector\app;

use tests\mock\Model\app\AppData;
use tests\mock\Mapper\app\AppDataMapper;
use Norm\ORM\Model\Model;
use Norm\ORM\Selector\Selector;

class AppDataSelector extends Selector
{
    protected function setModelMapper(): AppDataMapper
    {
        return new AppDataMapper();
    }

    /**
     * @return AppData|Model
     */
    public function createModel(): AppData
    {
        return parent::createModel();
    }
}
