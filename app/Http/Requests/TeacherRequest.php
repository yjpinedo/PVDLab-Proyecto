<?php

namespace App\Http\Requests;

class TeacherRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'document_type' => 'required',
            'document' => 'required|numeric|digits_between:6,12|unique:teachers,document,' . $this->id,
            'name' => 'required|min:3|max:50|alpha_space',
            'last_name' => 'required|min:3|max:50|alpha_space',
            'sex' => 'required|in:' . implode(',', array_keys(__('app.selects.person.sex'))),
            'birth_date' => 'required|date|before:today',
            'address' => 'required|min:3|max:50',
            'neighborhood' => 'required|min:3|max:50',
            'phone' => 'required_without:cellphone|numeric|digits_between:6,12|bail',
            'cellphone' => 'nullable|numeric|digits_between:6,12|bail',
            'email' => 'required|email|unique:users,email,' . $this->id . '|unique:teachers,email,' . $this->id,
            'title' => 'required|min:3|max:100',
            'title_type' => 'required|in:' . implode(',', array_keys(__('app.selects.teacher.title_type'))),
            'collage' => 'required|min:3|max:100',
            'year' => 'required|date_format:Y',
        ];
    }
}
