<?php

namespace Modules\Iredeems\Repositories\Cache;

use Modules\Iredeems\Repositories\PointRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CachePointDecorator extends BaseCacheDecorator implements PointRepository
{
    public function __construct(PointRepository $point)
    {
        parent::__construct();
        $this->entityName = 'iredeems.points';
        $this->repository = $point;
    }
}
