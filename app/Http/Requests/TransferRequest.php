<?php

namespace App\Http\Requests;

class TransferRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => 'required|date|after_or_equal:today',
            'type' => 'required|min:3|max:90|alpha_space',
            'origin_id' => 'required|min:3|max:90|alpha_space',
            'destination_id' => 'required|min:3|max:90|alpha_space',
            'beneficiary_id' => 'required|exists:beneficiaries,id',
            'employee_id' => 'required|exists:employees,id',
            'project_id' => 'required|exists:projects,id',
        ];
    }
}
