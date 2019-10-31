<?php

namespace Modules\Iredeems\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreatePointRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'user_id' => 'required',
            'pointable_id' => 'required',
            'pointable_type' => 'required',
            'points' => 'required',
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
        return [
            'user_id.required' => trans('iredeems::common.messages.field required is required'),
            'pointable_id.required' => trans('iredeems::common.messages.field required is required'),
            'pointable_type.required' => trans('iredeems::common.messages.field required is required'),
            'points.required' => trans('iredeems::common.messages.field required is required'),
        ];
    }

    public function translationMessages()
    {
        return [
            'user_id.required' => trans('iredeems::common.messages.field required is required'),
            'pointable_id.required' => trans('iredeems::common.messages.field required is required'),
            'pointable_type.required' => trans('iredeems::common.messages.field required is required'),
            'points.required' => trans('iredeems::common.messages.field required is required'),
        ];
    }
}
