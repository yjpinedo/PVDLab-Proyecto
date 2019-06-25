<?php

namespace App\Http\Requests;

class CourseRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'required|unique:courses,code,' . $this->id,
            'name' => 'required|min:3|max:50|alpha_space',
            'description' => 'min:3|max:200',
            'teacher_id' => 'required|exists:teachers,id',
        ];
    }
}
