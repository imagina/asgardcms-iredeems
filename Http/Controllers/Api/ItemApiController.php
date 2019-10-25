<?php

namespace Modules\Iredeems\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;
use Modules\Iredeems\Http\Requests\CreateItemRequest;
use Modules\Iredeems\Http\Requests\UpdateItemRequest;
use Modules\Iredeems\Repositories\ItemRepository;
use Modules\Iredeems\Transformers\ItemTransformer;

class ItemApiController extends BaseApiController
{
  private $item;
  public function __construct(
    ItemRepository $itemRepository
    )
  {
    parent::__construct();
    $this->item = $itemRepository;
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
      $items = $this->item->getItemsBy($this->getParamsRequest($request));

      //Response
      $response = ["data" => ItemTransformer::collection($items)];

      //If request pagination add meta-page
      $request->page ? $response['meta'] = ['page' => $this->pageTransformer($items)] : false;
      
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
      $item = $this->item->getItem($criteria,$this->getParamsRequest($request));

      //Break if no found item
      if (!$item) throw new \Exception('Item not found', 204);

      $response = [
        'data' => $item ? new ItemTransformer($item) : '',
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
      $this->validateRequestApi(new CreateItemRequest($data));

      //Create
      $item = $this->item->create($data);

      //Response
      $response = ["data" => new ItemTransformer($item)];

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
      $this->validateRequestApi(new UpdateItemRequest($data));

      $params = $this->getParamsRequest($request);
      
      // Search entity
      $entity = $this->item->getItem($criteria,$params);

      //Break if no found item
      if (!$entity) throw new \Exception('Item not found', 204);

      $item = $this->item->update($entity,$data);

      $response = ['data' => new ItemTransformer($item)];

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
      $entity = $this->item->getItem($criteria,$params);

      //Break if no found item
      if (!$entity) throw new \Exception('Item not found', 204);

      $this->item->destroy($entity);

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
