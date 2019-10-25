<?php

namespace Modules\Iredeems\Transformers;

use Illuminate\Http\Resources\Json\Resource;
class ItemTransformer extends Resource
{
  public function toArray($request)
  {
    $data =  [
      'id' => $this->id,
      'name' => $this->name,
      'value' => $this->value,
      'createdAtDate' => $this->created_at->format('Y-m-d'),
      'createdAtTime' => $this->created_at->format('H:i:s'),
      'updateAtDate' => $this->updated_at->format('Y-m-d'),
      'updateAtTime' => $this->updated_at->format('H:i:s'),
    ];

    return $data;
  }
}
