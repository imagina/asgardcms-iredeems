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

    /*== RELATIONSHIPS ==*/
    if (in_array('*', $params->include)) {//If Request all relationships
      $query->with([]);
    } else {//Especific relationships
      $includeDefault = ['translations'];//Default relationships
      if (isset($params->include))//merge relations with default relationships
        $includeDefault = array_merge($includeDefault, $params->include);
      $query->with($includeDefault);//Add Relationships to query
    }

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

      //Random
      if (isset($filter->random)) {
        $query->inRandomOrder();
      }

      //Order by
      if (isset($filter->order)) {
        $orderByField = $filter->order->field ?? 'created_at';//Default field
        $orderWay = $filter->order->way ?? 'desc';//Default way
        $query->orderBy($orderByField, $orderWay);//Add order to query
      }

    }

    /*== FIELDS ==*/
    if (isset($params->fields) && count($params->fields))
     $query->select($params->fields);

    /*== REQUEST ==*/
    if (isset($params->page) && $params->page) {
      return $query->paginate($params->take);
    } else {
      $params->take ? $query->take($params->take) : false;//Take
      return $query->get();
    }
  }//getItemsBy()

  public function getItem($criteria, $params = false)
  {
      // INITIALIZE QUERY
      $query = $this->model->query();

      /*== RELATIONSHIPS ==*/
      if (in_array('*', $params->include)) {//If Request all relationships
        $query->with([]);
      } else {//Especific relationships
        $includeDefault = ['translations'];//Default relationships
        if (isset($params->include))//merge relations with default relationships
          $includeDefault = array_merge($includeDefault, $params->include);
        $query->with($includeDefault);//Add Relationships to query
      }

      /*== FILTER ==*/
      if (isset($params->filter)) {

        $filter = $params->filter;

        // find translatable attributes
        $translatedAttributes = $this->model->translatedAttributes;

        if(isset($filter->field))
          $field = $filter->field;

        // filter by translatable attributes
        if (isset($field) && in_array($field, $translatedAttributes))//Filter by slug
          $query->whereHas('translations', function ($query) use ($criteria, $filter, $field) {
            $query->where('locale', $filter->locale)
              ->where($field, $criteria);
          });
        else
          // find by specific attribute or by id
          $query->where($field ?? 'id', $criteria);

      }


      return $query->first();

  }

}
