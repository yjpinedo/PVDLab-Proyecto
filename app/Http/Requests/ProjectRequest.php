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
            'code' => 'required|unique:projects,code,' . $this->id,
            'name' => 'required|min:3|max:50|alpha_space',
            'date' => 'required|date|after_or_equal:today',
            'start' => 'required|date|after_or_equal:today',
            'type' => 'required|in:' . implode(',', array_keys(__('app.selects.project.type'))),
            'other_type' => 'max:90',
            'description' => 'min:3|max:200',
            'origin' => 'required|in:' . implode(',', array_keys(__('app.selects.project.origin'))),
            'other_origin' => 'max:90',
            'state' => 'required|in:' . implode(',', array_keys(__('app.selects.project.state'))),
            'financing' => 'required|in:' . implode(',', array_keys(__('app.selects.project.financing'))),
            'financial_entity' => 'max:90',
            'financing_description' => 'max:200',
            'observations' => 'max:200',
            'concept' => 'required|in:' . implode(',', array_keys(__('app.selects.project.concept'))),
        ];
    }
}
