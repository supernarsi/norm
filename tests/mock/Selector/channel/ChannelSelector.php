<?php declare(strict_types=1);

namespace tests\mock\Selector\Channel;

use tests\mock\Model\Channel\Channel;
use tests\mock\Mapper\Channel\ChannelMapper;
use Norm\ORM\Model\Model;
use Norm\ORM\Selector\Selector;

class ChannelSelector extends Selector
{
    protected function setModelMapper(): ChannelMapper
    {
        return new ChannelMapper();
    }

    /**
     * @return Channel|Model
     */
    public function createModel(): Channel
    {
        return parent::createModel();
    }
}
