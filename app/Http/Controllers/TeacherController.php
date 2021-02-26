<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherRequest;
use App\Teacher;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class TeacherController extends BaseController
{
    /**
     * Create a controller instance.
     *
     * @param Teacher $entity
     */
    public function __construct(Teacher $entity)
    {
        parent::__construct($entity, true);
        $this->model = $this->entity->orderBy('created_at', 'DESC');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TeacherRequest $request
     * @return JsonResponse
     */
    public function store(TeacherRequest $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email|unique:teachers,email',
        ]);
        return parent::storeBase($request, false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TeacherRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(TeacherRequest $request, int $id)
    {
        $user = User::where([
            ['model_id', $id],
            ['model_type', 'App\Teacher']
        ])->first();
        $user_id = 0;

        if (!is_null($user)){
            $user_id = $user->id;
        }
        $request->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('teachers', 'email')->ignore($id),
                Rule::unique('users', 'email')->ignore($user_id),
            ],
        ]);

        return parent::updateBase($request, $id);
    }
}
