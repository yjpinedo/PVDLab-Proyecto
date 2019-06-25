<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Http\Requests\EmployeeRequest;
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
        parent::__construct($entity);
        $this->model = $this->entity->with('position')->orderBy('created_at');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EmployeeRequest $request
     * @return Response
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
     * @return Response
     */
    public function update(EmployeeRequest $request, int $id)
    {
        return parent::updateBase($request, $id);
    }
}
