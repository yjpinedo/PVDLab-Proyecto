<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovementRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required|in:' . implode(',', array_keys(__('app.selects.movement.type'))),
            'date' => 'required|date|after_or_equal:today',
            'stock' => 'required|numeric',
            'origin_id' => 'required|exists:warehouses,id',
            'destination_id' => 'required|exists:warehouses,id',
        ];
    }
}
