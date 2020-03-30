<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WarehouseRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'required|unique:locations,code,' . $this->id,
            'name' => 'required|min:3|max:50|alpha_space',
            'description' => 'min:3|max:200',
        ];
    }
}
