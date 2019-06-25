<?php

namespace App\Http\Requests;

class FurnitureRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'required|unique:furniture,code,' . $this->id,
            'name' => 'required|min:2|max:50|alpha_space',
            'brand' => 'required|min:3|max:50|alpha_space',
            'serial' => 'required|numeric|digits_between:6,12|unique:furniture,serial,' . $this->id,
            'pattern' => 'required|min:3|max:50',
            'description' => 'min:3|max:200',
            'category_id' => 'required|exists:categories,id',
            'location_id' => 'required|exists:locations,id',
        ];
    }
}
