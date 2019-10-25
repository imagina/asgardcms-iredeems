<?php

namespace Modules\Iredeems\Repositories\Cache;

use Modules\Iredeems\Repositories\PointHistoryRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CachePointHistoryDecorator extends BaseCacheDecorator implements PointHistoryRepository
{
    public function __construct(PointHistoryRepository $pointhistory)
    {
        parent::__construct();
        $this->entityName = 'iredeems.pointhistories';
        $this->repository = $pointhistory;
    }
}
