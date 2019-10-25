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
