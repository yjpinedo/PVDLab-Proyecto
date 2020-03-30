<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'required|unique:articles,code,' . $this->id,
            'name' => 'required|min:2|max:50|alpha_space',
            'brand' => 'required|min:3|max:50|alpha_space',
            'serial' => 'required|numeric|digits_between:6,12|unique:articles,serial,' . $this->id,
            'pattern' => 'required|min:3|max:50',
            'description' => 'min:3|max:200',
            'stock' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'warehouse_id' => 'required|exists:warehouses,id',
        ];
    }
}
