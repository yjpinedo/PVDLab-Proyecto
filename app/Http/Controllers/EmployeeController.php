<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Http\Requests\EmployeeRequest;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
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
        $request->validate([
            'email' => 'required|email|unique:employees,email,' . $id,
        ]);
        return parent::updateBase($request, $id);
    }
}
