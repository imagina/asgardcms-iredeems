<?php

namespace Modules\Iredeems\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface PointRepository extends BaseRepository
{

    public function getItemsBy($params);

    public function getItem($criteria, $params);

    public function getTotalPoints($params);

    public function getAvailablePoints($params);
    
}
