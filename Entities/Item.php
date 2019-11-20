<?php

namespace Modules\Iredeems\Entities;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

use Modules\Media\Support\Traits\MediaRelation;
use Modules\Media\Entities\File;

class Item extends Model
{
  use Translatable, MediaRelation;

  protected $table = 'iredeems__items';
  public $translatedAttributes = [
    'name'
  ];
  protected $fillable = [
    'value'
  ];

  public function redeems()
  {
    return $this->hasMany(Redeem::class);
  }

  public function getMainImageAttribute()
  {
      $thumbnail = $this->files()->where('zone', 'mainimage')->first();
      if (!$thumbnail) return [
      'mimeType' => 'image/jpeg',
      'path' => url('modules/iblog/img/category/default.jpg')
      ];
      return [
      'mimeType' => $thumbnail->mimetype,
      'path' => $thumbnail->path_string
      ];
  }

}
