<?php

namespace Modules\Iredeems\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class RedeemTransformer extends Resource
{
  public function toArray($request)
  {
    $item =  [
      'id' => $this->when($this->id,$this->id),
      'userId' => $this->when($this->user_id,$this->user_id),
      'description' => $this->when($this->description,$this->description),
      'points' => $this->when($this->points,$this->points),
      'createdAtDate' => $this->when($this->created_at->format('Y-m-d'),$this->created_at->format('Y-m-d')),
      'createdAtTime' => $this->when($this->created_at->format('H:i:s'),$this->created_at->format('H:i:s')),
      'updateAtDate' => $this->when($this->updated_at->format('Y-m-d'),$this->updated_at->format('Y-m-d')),
      'updateAtTime' => $this->when($this->updated_at->format('H:i:s'),$this->updated_at->format('H:i:s')),
    ];

    return $item;

  }
}
