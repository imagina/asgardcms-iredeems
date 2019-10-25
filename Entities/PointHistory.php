<?php

namespace Modules\Iredeems\Entities;

use Illuminate\Database\Eloquent\Model;

class PointHistory extends Model
{

    protected $table = 'iredeems__pointhistories';
    protected $fillable = [
      'user_id',
      'description',
      'points'
    ];

}
