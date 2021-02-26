<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Http\Requests\EmployeeRequest;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class EmployeeController extends BaseController
{
    /**
     * Create a controller instance.
     *
     * @param Employee $entity
     */
    public function __construct(Employee $entity)
    {
        parent::__construct($entity, true);
        $this->model = $this->entity->with('position')->orderBy('created_at', 'DESC');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EmployeeRequest $request
     * @return JsonResponse
     */
    public function store(EmployeeRequest $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email|unique:employees,email',
        ]);
        return parent::storeBase($request, false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EmployeeRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(EmployeeRequest $request, int $id)
    {
        $user = User::where([
            ['model_id', $id],
            ['model_type', 'App\Employee']
        ])->first();
        $user_id = 0;

        if (!is_null($user)){
            $user_id = $user->id;
        }

        $request->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('employees', 'email')->ignore($id),
                Rule::unique('users', 'email')->ignore($user_id),
            ],
        ]);
        return parent::updateBase($request, $id);
    }
}
