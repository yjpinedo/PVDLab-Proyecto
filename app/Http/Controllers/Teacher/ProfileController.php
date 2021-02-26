<?php

namespace App\Http\Controllers\Teacher;

use App\Teacher;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('teachers.profile', [
            'teacher' => Teacher::whereId(Auth::user()['model_id'])->first(),
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request) {

        $id = Auth::user()['model_id'];
        $user = User::where([
            ['model_id', $id],
            ['model_type', Auth::user()['model_type']]
        ])->first();

        $user_id = 0;

        if (!is_null($user)){
            $user_id = $user->id;
        }

        $request->validate([
            'document_type' => 'required',
            'document' => 'required|numeric|digits_between:6,12|unique:employees,document,' . $id,
            'expedition_place' => 'required|min:3|max:50',
            'name' => 'required|min:3|max:50|alpha_space',
            'last_name' => 'required|min:3|max:50|alpha_space',
            'sex' => 'required|in:' . implode(',', array_keys(__('app.selects.person.sex'))),
            'birth_date' => 'required|date|before:today',
            'place_of_birth' => 'required|min:3|max:50',
            'address' => 'required|min:3|max:50',
            'neighborhood' => 'required|min:3|max:50',
            'phone' => 'required_without:cellphone|numeric|digits_between:6,12|bail',
            'cellphone' => 'nullable|numeric|digits_between:6,12|bail',
            'email' => [
                'required',
                'email',
                Rule::unique('teachers', 'email')->ignore($id),
                Rule::unique('users', 'email')->ignore($user_id),
            ],
            'title' => 'required|min:3|max:100',
            'title_type' => 'required|in:' . implode(',', array_keys(__('app.selects.teacher.title_type'))),
            'collage' => 'required|min:3|max:100',
            'year' => 'required|date_format:Y',
        ]);

        $teacher = Teacher::find($id)->fill($request->all());
        $teacher->save();

        if ($user->email != $teacher->email) {
            $user->email = $teacher->email;
            $user->save();
        }

        return response()->json([
            'data' => $teacher,
            'message' => __('base.messages.update', ['name' => $teacher->full_name]),
        ]);
    }
}
