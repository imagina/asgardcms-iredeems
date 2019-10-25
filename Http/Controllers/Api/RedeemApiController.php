<?php

namespace Modules\Iredeems\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;
use Modules\Iredeems\Http\Requests\CreateRedeemRequest;
use Modules\Iredeems\Http\Requests\UpdateRedeemRequest;
use Modules\Iredeems\Repositories\RedeemRepository;
// use Modules\Iredeems\Transformers\RedeemTransformer;

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
   * Show the form for creating a new resource.
   * @return Response
   */
  public function create(Request $request)
  {
    try {
      \DB::beginTransaction();
      //Validate Request
      $this->validateRequestApi(new CreateRedeemRequest($request->all()));
      $pointsAvailable=iredeems_availablePointsOfUser($request->user_id);
      if($pointsAvailable<$request->used_points){
        throw new \Exception("Not points available",500);
      }
      //Create
      $redeem = $this->redeem->create($request->all());
      //Event to save history points user
      event(new \Modules\Iredeems\Events\RedeemWasCreated($redeem,$request->all()));

      $response = ['data' => $redeem];
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

}
