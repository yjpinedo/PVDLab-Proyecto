<?php

namespace App\Http\Requests;

class FurnitureTransferRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'transfer_id' => 'required|exists:transfers,id',
            'furniture_id' => 'required|exists:furniture,id',
        ];
    }
}
