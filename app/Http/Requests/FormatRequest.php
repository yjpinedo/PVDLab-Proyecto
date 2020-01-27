<?php

namespace App\Http\Requests;

class FormatRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //'beneficiary_id' => 'required|exists:beneficiaries,id',
        ];
    }
}
