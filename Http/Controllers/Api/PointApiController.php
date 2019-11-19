<?php

namespace Modules\Iredeems\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;
use Modules\Iredeems\Http\Requests\CreatePointRequest;
use Modules\Iredeems\Http\Requests\UpdatePointRequest;
use Modules\Iredeems\Repositories\PointRepository;
use Modules\Iredeems\Transformers\PointTransformer;

class PointApiController extends BaseApiController
{
  private $point;
  public function __construct(
    PointRepository $pointRepository
    )
  {
    parent::__construct();
    $this->point = $pointRepository;
  }

  /**
   * GET ITEMS
   *
   * @return mixed
   */
  public function index(Request $request)
  {
    try {

      //Request to Repository
      $points = $this->point->getItemsBy($this->getParamsRequest($request));

      //Response
      $response = ["data" => PointTransformer::collection($points)];

      //If request pagination add meta-page
      $request->page ? $response['meta'] = ['page' => $this->pageTransformer($points)] : false;
      
    } catch (\Exception $e) {
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];
    }

    //Return response
    return response()->json($response, $status ?? 200);
  }

  /** SHOW
   * @param Request $request
   *  URL GET:
   *  &fields = type string
   *  &include = type string
   */
  public function show($criteria, Request $request)
  {
    try {
      //Request to Repository
      $point = $this->point->getItem($criteria,$this->getParamsRequest($request));

      //Break if no found item
      if (!$point) throw new \Exception('Item not found', 204);

      $response = [
        'data' => $point ? new PointTransformer($point) : '',
      ];

    } catch (\Exception $e) {
      \Log::error($e);
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];
    }
    return response()->json($response, $status ?? 200);
  }

   /**
   * Show the form for creating a new resource.
   * @return Response
   */
  public function create(Request $request)
  {

    \DB::beginTransaction();

    try{

      //Get data
      $data = $request['attributes'] ?? [];

      //Validate Request
      $this->validateRequestApi(new CreatePointRequest($data));

      //Create
      $point = $this->point->create($data);

      //Response
      $response = ["data" => new PointTransformer($point)];

      \DB::commit(); //Commit to Data Base

    } catch (\Exception $e) {

        \Log::error($e);
        \DB::rollback();//Rollback to Data Base
        $status = $this->getStatusError($e->getCode());
        $response = ["errors" => $e->getMessage()];
    }

    return response()->json($response, $status ?? 200);

  }

  /**
   * Update the specified resource in storage.
   * @param  Request $request
   * @return Response
   */
  public function update($criteria, Request $request)
  {
    try {

      \DB::beginTransaction();

      //Get data
      $data = $request['attributes'] ?? [];

      //Validate Request
      $this->validateRequestApi(new UpdatePointRequest($data));

      $params = $this->getParamsRequest($request);
      
      // Search entity
      $entity = $this->point->getItem($criteria,$params);

      //Break if no found item
      if (!$entity) throw new \Exception('Item not found', 204);

      $point = $this->point->update($entity,$data);

      $response = ['data' => new PointTransformer($point)];

      \DB::commit(); //Commit to Data Base

    } catch (\Exception $e) {

      \Log::error($e);
      \DB::rollback();//Rollback to Data Base
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];
      
    }

    return response()->json($response, $status ?? 200);

  }

  /**
   * Remove the specified resource from storage.
   * @return Response
   */
  public function delete($criteria, Request $request)
  {
    try {

      //Get params
      $params = $this->getParamsRequest($request);

      // Search entity
      $entity = $this->point->getItem($criteria,$params);

      //Break if no found item
      if (!$entity) throw new \Exception('Item not found', 204);

      $this->point->destroy($entity);

      $response = ['data' => 'Item deleted'];

    } catch (\Exception $e) {

      \Log::Error($e);
      \DB::rollback();//Rollback to Data Base
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];
    }

    return response()->json($response, $status ?? 200);
    
  }

   /**
   * Get calculates about Points
   * @return Response
   */
  public function calculates(Request $request){
    
    try {

      // Params
      $params = $this->getParamsRequest($request);

      // Get Filters
      if($params->filter) {
        $filter = $params->filter;

        if(isset($filter->type)){
          
          // Obtain total points earned by the user
          if($filter->type=="totalPointsUser"){
            $points = $this->point->getTotalPoints($params);
            $data = array(
              "points" => (int)$points,
              "userId" => $filter->userId
            );
          }

          // Obtain Available points by user
          if($filter->type=="availablePointsUser"){
            $points = $this->point->getAvailablePoints($params);
            $data = array(
              "points" => (int)$points,
              "userId" => $filter->userId
            );
          }

          // Obtain Total points by user, group by type
          if($filter->type=="groupTotalPointsUser"){
            $data = $this->point->getGroupTotalPoints($params);
          }

        }

      }
      
      $response = [
        'data' => $data ? $data : '',
      ];
     
     
    } catch (\Exception $e) {
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];
    }

    //Return response
    return response()->json($response, $status ?? 200);
  }

}
