<?php

namespace Modules\Iredeems\Repositories\Cache;

use Modules\Iredeems\Repositories\RedeemRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheRedeemDecorator extends BaseCacheDecorator implements RedeemRepository
{
    public function __construct(RedeemRepository $redeem)
    {
        parent::__construct();
        $this->entityName = 'iredeems.redeems';
        $this->repository = $redeem;
    }
}
