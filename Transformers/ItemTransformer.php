<?php

namespace Modules\Iredeems\Transformers;

use Illuminate\Http\Resources\Json\Resource;
class ItemTransformer extends Resource
{
  public function toArray($request)
  {
    $item =  [
      'id' => $this->when($this->id,$this->id),
      'name' => $this->when($this->name,$this->name),
      'value' => $this->when($this->value,$this->value),
      'mainImage' => $this->mainImage,
      'createdAt' => $this->when($this->created_at,$this->created_at),
      'updatedAt' => $this->when($this->updated_at,$this->updated_at)
    ];

    // TRANSLATIONS
    $filter = json_decode($request->filter);
    // Return data with available translations
    if (isset($filter->allTranslations) && $filter->allTranslations) {
      // Get langs avaliables
      $languages = \LaravelLocalization::getSupportedLocales();
      foreach ($languages as $lang => $value) {
        if ($this->hasTranslation($lang)) {
          $item[$lang]['name'] = $this->hasTranslation($lang) ?
            $this->translate("$lang")['name'] : '';
        }
      }
    }

    return $item;
  }
}
