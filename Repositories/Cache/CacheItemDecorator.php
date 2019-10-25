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

       /**
   * List or resources
   *
   * @return collection
   */
    public function getItemsBy($params)
    {
        return $this->remember(function () use ($params) {
        return $this->repository->getItemsBy($params);
        });
    }
    
    /**
     * find a resource by id or slug
     *
     * @return object
     */
    public function getItem($criteria, $params)
    {
        return $this->remember(function () use ($criteria, $params) {
        return $this->repository->getItem($criteria, $params);
        });
    }

}
