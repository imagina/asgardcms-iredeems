<?php

namespace Modules\Iredeems\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface RedeemRepository extends BaseRepository
{

    public function getItemsBy($params);

    public function getItem($criteria, $params);

    public function getRedeemedPoints($params);
    
}
