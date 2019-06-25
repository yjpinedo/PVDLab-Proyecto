<?php

namespace App\Http\Requests;


class LessonRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => 'required|date|after_or_equal:today',
            'course_id' => 'required|exists:courses,id',
        ];
    }
}
