<?php

namespace App\Http\Requests;

class BeneficiaryRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'document_type' => 'required',
            'document' => 'required|numeric|digits_between:6,12|unique:beneficiaries,document,' . $this->id,
            'expedition_place' => 'required|min:3|max:50',
            'name' => 'required|min:3|max:50|alpha_space',
            'last_name' => 'required|min:3|max:50|alpha_space',
            'sex' => 'required|in:' . implode(',', array_keys(__('app.selects.person.sex'))),
            'birth_date' => 'required|date|before:today',
            'place_of_birth' => 'required|min:3|max:50',
            'address' => 'required|min:3|max:50',
            'neighborhood' => 'required|min:3|max:50',
            'cellphone' => 'required_without:cellphone|numeric|digits_between:6,12|bail',
            'phone' => 'nullable|numeric|digits_between:6,12|bail',
            'occupation' => 'min:3|max:200',
            'ethnic_group' => 'required|in:' . implode(',', array_keys(__('app.selects.person.ethnic_group'))),
            'other_ethnic_group' => 'min:3|max:90',
            'stratum' => 'required|in:' . implode(',', array_keys(__('app.selects.person.stratum'))),
        ];
    }
}
