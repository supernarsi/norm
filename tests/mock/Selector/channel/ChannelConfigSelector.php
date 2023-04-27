<?php declare(strict_types=1);

namespace tests\mock\Selector\channel;

use tests\mock\Model\channel\ChannelConfig;
use tests\mock\Mapper\channel\ChannelConfigMapper;
use Norm\ORM\Model\Model;
use Norm\ORM\Selector\Selector;

class ChannelConfigSelector extends Selector
{
    protected function setModelMapper(): ChannelConfigMapper
    {
        return new ChannelConfigMapper();
    }

    /**
     * @return ChannelConfig|Model
     */
    public function createModel(): ChannelConfig
    {
        return parent::createModel();
    }
}
