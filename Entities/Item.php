<?php

namespace Modules\Iredeems\Entities;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Item extends Model
{
  use Translatable;
  protected $table = 'iredeems__items';
  public $translatedAttributes = [
    'name'
  ];
  protected $fillable = [
    'value'
  ];
}
