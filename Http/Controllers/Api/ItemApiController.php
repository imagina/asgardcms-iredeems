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
      //Get Parameters from URL.
      $params = $this->getParamsRequest($request);

      //Request to Repository
      $item = $this->item->getItemsBy($params);

      //Response
      $response = ["data" => ItemTransformer::collection($item)];

      //If request pagination add meta-page
      $params->page ? $response["meta"] = ["page" => $this->pageTransformer($item)] : false;
    } catch (\Exception $e) {
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];
    }

    //Return response
    return response()->json($response, $status ?? 200);
  }

}
