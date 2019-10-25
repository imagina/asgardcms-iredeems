<?php

namespace Modules\Iredeems\Repositories\Eloquent;

use Modules\Iredeems\Repositories\ItemRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentItemRepository extends EloquentBaseRepository implements ItemRepository
{

  public function getItemsBy($params = false)
  {
    /*== initialize query ==*/
    $query = $this->model->query();

    /*== FILTERS ==*/
    if (isset($params->filter)) {
      $filter = $params->filter;//Short filter

      //Filter by date
      if (isset($filter->date)) {
        $date = $filter->date;//Short filter date
        $date->field = $date->field ?? 'created_at';
        if (isset($date->from))//From a date
        $query->whereDate($date->field, '>=', $date->from);
        if (isset($date->to))//to a date
        $query->whereDate($date->field, '<=', $date->to);
      }

      //Order by
      if (isset($filter->order)) {
        $orderByField = $filter->order->field ?? 'created_at';//Default field
        $orderWay = $filter->order->way ?? 'desc';//Default way
        $query->orderBy($orderByField, $orderWay);//Add order to query
      }

    }

    /*== REQUEST ==*/
    if (isset($params->page) && $params->page) {
      return $query->paginate($params->take);
    } else {
      $params->take ? $query->take($params->take) : false;//Take
      return $query->get();
    }
  }//getItemsBy()

}
