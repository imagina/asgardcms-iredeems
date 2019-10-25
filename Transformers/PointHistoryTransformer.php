<?php

namespace Modules\Iredeems\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Icommerce\Transformers\ProductTransformer;
use Modules\Iredeems\Transformers\ItemTransformer;
class PointHistoryTransformer extends Resource
{
  public function toArray($request)
  {
    $data =  [
      'id' => $this->id,
      'type' => $this->type,
      'points' => $this->points,
      'product'=>new ProductTransformer($this->whenLoaded('product')),
      'item'=>new ItemTransformer($this->whenLoaded('item')),
      'createdAtDate' => $this->created_at->format('d-m-Y'),
      'createdAtTime' => $this->created_at->format('H:i:s'),
      'updateAtDate' => $this->updated_at->format('d-m-Y'),
      'updateAtTime' => $this->updated_at->format('H:i:s'),
    ];

    return $data;
  }
}
