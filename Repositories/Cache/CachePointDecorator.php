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

    /* List or resources
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
     public function getTotalPoints($params)
     {
        return $this->remember(function () use ($params) {
        return $this->repository->getTotalPoints($params);
            });
     }

     public function getAvailablePoints($params)
     {
        return $this->remember(function () use ($params) {
        return $this->repository->getAvailablePoints($params);
                });
     }


}
