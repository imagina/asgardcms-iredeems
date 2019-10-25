<?php

namespace Modules\Iredeems\Entities;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{

    protected $table = 'iredeems__points';
    protected $fillable = [
      'user_id',
      'pointable_id',
      'pointable_type',
      'description',
      'points'
    ];

    public function product()
    {
      return $this->belongsTo("Modules\Icommerce\Entities\Product","entity_id");
    }
    public function item()
    {
      return $this->belongsTo("Modules\Iredeems\Entities\Item","entity_id");
    }
}
