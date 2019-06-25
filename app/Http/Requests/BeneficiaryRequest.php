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
            'name' => 'required|min:3|max:50|alpha_space',
            'last_name' => 'required|min:3|max:50|alpha_space',
            'sex' => 'required|in:' . implode(',', array_keys(__('app.selects.person.sex'))),
            'birth_date' => 'required|date|before:Today',
            'place_of_birth' => 'required|min:3|max:50',
            'address' => 'required|min:3|max:50',
            'neighborhood' => 'required|min:3|max:50',
            'phone' => 'required_without:cellphone|numeric|digits_between:6,12|bail',
            'cellphone' => 'nullable|numeric|digits_between:6,12|bail',
            'email' => 'required|email|unique:users,email,' . $this->id . '|unique:beneficiaries,email,' . $this->id,
            'occupation' => 'min:3|max:200',
            'ethnic_group' => 'required|in:' . implode(',', array_keys(__('app.selects.person.ethnic_group'))),
            'stratum' => 'required|in:' . implode(',', array_keys(__('app.selects.person.stratum'))),
        ];
    }
}
