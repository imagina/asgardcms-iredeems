<?php

namespace Modules\Iredeems\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateItemRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
          'value'=>'required|numeric'
        ];
    }

    public function translationRules()
    {
        return [
          'name'=>'required|string'
        ];
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
