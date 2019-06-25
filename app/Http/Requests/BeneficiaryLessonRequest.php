<?php

namespace App\Http\Requests;

class BeneficiaryLessonRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'beneficiary_id' => 'required|exists:beneficiaries,id',
            'lesson_id' => 'required|exists:lessons,id',
        ];
    }
}
