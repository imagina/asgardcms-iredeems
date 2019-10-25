<?php

namespace Modules\Iredeems\Repositories\Cache;

use Modules\Iredeems\Repositories\ItemRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheItemDecorator extends BaseCacheDecorator implements ItemRepository
{
    public function __construct(ItemRepository $item)
    {
        parent::__construct();
        $this->entityName = 'iredeems.items';
        $this->repository = $item;
    }
}
