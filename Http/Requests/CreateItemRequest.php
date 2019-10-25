<?php

namespace Modules\Iredeems\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateItemRequest extends BaseFormRequest
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
          'name'=>'required'
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
