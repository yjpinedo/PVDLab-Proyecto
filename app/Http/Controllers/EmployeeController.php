<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

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
        return parent::updateBase($request, $id);
    }
}
