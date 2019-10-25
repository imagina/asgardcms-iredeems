<?php

namespace Modules\Iredeems\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;
use Modules\Iredeems\Http\Requests\CreateRedeemRequest;
use Modules\Iredeems\Http\Requests\UpdateRedeemRequest;
use Modules\Iredeems\Repositories\RedeemRepository;
use Modules\Iredeems\Transformers\RedeemTransformer;

class RedeemApiController extends BaseApiController
{
  private $redeem;
  public function __construct(
    RedeemRepository $redeemRepository
    )
  {
    parent::__construct();
    $this->redeem = $redeemRepository;
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
      $redeems = $this->redeem->getItemsBy($this->getParamsRequest($request));

      //Response
      $response = ["data" => RedeemTransformer::collection($redeems)];

      //If request pagination add meta-page
      $request->page ? $response['meta'] = ['page' => $this->pageTransformer($redeems)] : false;
      
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
      $redeem = $this->redeem->getItem($criteria,$this->getParamsRequest($request));

      //Break if no found item
      if (!$redeem) throw new \Exception('Item not found', 204);

      $response = [
        'data' => $redeem? new RedeemTransformer($redeem) : '',
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

    try {

      //Get data
      $data = $request['attributes'] ?? [];

      //Validate Request
      $this->validateRequestApi(new CreateRedeemRequest($data));

      // Validate Points has User
      $pointsAvailable = iredeems_availablePointsOfUser($request->user_id);

      // User can't get the item
      if($pointsAvailable<$request->used_points){
        throw new \Exception("Not points available",500);
      }
     
      //Create
      $redeem = $this->redeem->create($data);
      
      //Response
      $response = ['data' => new RedeemTransformer($redeem)];

      \DB::commit(); //Commit to Data Base

    } catch (\Exception $e) {
      \DB::rollback();//Rollback to Data Base
      $status = 500;
      $response = [
        'errors' => $e->getMessage()
      ];
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
      $this->validateRequestApi(new UpdateRedeemRequest($data));

      $params = $this->getParamsRequest($request);
      
      // Search entity
      $entity = $this->redeem->getItem($criteria,$params);

      //Break if no found item
      if (!$entity) throw new \Exception('Item not found', 204);

      $redeem = $this->redeem->update($entity,$data);

      $response = ['data' => new RedeemTransformer($redeem)];

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
      $entity = $this->redeem->getItem($criteria,$params);

      //Break if no found item
      if (!$entity) throw new \Exception('Item not found', 204);

      $this->redeem->destroy($entity);

      $response = ['data' => 'Item deleted'];

    } catch (\Exception $e) {

      \Log::Error($e);
      \DB::rollback();//Rollback to Data Base
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];
    }

    return response()->json($response, $status ?? 200);
    
  }

}
