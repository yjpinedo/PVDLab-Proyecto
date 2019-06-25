<?php

namespace App\Http\Requests;

class LocationRequest extends BaseRequest
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
