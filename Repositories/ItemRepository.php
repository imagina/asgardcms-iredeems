<?php

namespace Modules\Iredeems\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface ItemRepository extends BaseRepository
{

  public function getItemsBy($params);

  
}
