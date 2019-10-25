<?php

namespace Modules\Iredeems\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateRedeemRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
          'user_id'=>'required|exists:users,id',
          //'item_id'=>'required|exists:iredeems__items,id',
          'description'=>'required',
          'points'=>'required|numeric'
        ];
    }

    public function translationRules()
    {
        return [];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }

    public function translationMessages()
    {
        return [];
    }
}
