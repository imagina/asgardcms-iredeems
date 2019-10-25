<?php

namespace Modules\Iredeems\Entities;

use Illuminate\Database\Eloquent\Model;

class ItemTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [
      'name'
    ];
    protected $table = 'iredeems__item_translations';
}
