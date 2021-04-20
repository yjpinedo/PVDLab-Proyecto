<?php

namespace App\Http\Requests;

class ProjectRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:50|alpha_space',
            'type' => 'required|in:' . implode(',', array_keys(__('app.selects.project.type'))),
            'other_type' => 'min:3|max:90',
            'description' => 'min:3|max:200',
            'origin' => 'required|in:' . implode(',', array_keys(__('app.selects.project.origin'))),
            'other_origin' => 'min:3|max:90',
            'state' => 'required|in:' . implode(',', array_keys(__('app.selects.project.state'))),
            'financing' => 'required|in:' . implode(',', array_keys(__('app.selects.project.financing'))),
            'financial_entity' => 'min:3|max:90',
            'financing_description' => 'min:3|max:200',
            'observations' => 'min:3|max:200',
            'concept' => 'in:' . implode(',', array_keys(__('app.selects.project.concept'))),
        ];
    }
}
