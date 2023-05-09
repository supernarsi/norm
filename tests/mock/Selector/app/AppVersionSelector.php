<?php declare(strict_types=1);

namespace tests\mock\Selector\app;

use tests\mock\Model\app\AppVersion;
use tests\mock\Mapper\app\AppVersionMapper;
use Norm\ORM\Model\Model;
use Norm\ORM\Selector\Selector;

class AppVersionSelector extends Selector
{
    protected function setModelMapper(): AppVersionMapper
    {
        return new AppVersionMapper();
    }

    /**
     * @return AppVersion|Model
     */
    public function createModel(): AppVersion
    {
        return parent::createModel();
    }
}
