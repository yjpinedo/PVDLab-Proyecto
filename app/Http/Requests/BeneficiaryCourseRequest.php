<?php

namespace App\Http\Requests;

class BeneficiaryCourseRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'confirm' => 'boolean',
            'beneficiary_id' => 'required|exists:beneficiaries,id',
            'course_id' => 'required|exists:courses,id',
        ];
    }
}
