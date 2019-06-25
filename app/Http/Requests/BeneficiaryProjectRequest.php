<?php

namespace App\Http\Requests;

class BeneficiaryProjectRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'project_id' => 'required|exists:projects,id',
            'beneficiary_id' => 'required|exists:beneficiaries,id',
        ];
    }
}
