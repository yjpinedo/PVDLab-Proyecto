<?php

namespace App\Http\Controllers;

use App\Http\Requests\BeneficiaryCourseRequest;
use App\BeneficiaryCourse;
use Illuminate\Http\Response;

class BeneficiaryCourseController extends BaseController
{
    /**
     * Create a controller instance.
     *
     * @param BeneficiaryCourse $entity
     */
    public function __construct(BeneficiaryCourse $entity)
    {
        parent::__construct($entity, false);
        $this->model = $this->entity->with('beneficiary','course')->orderBy('created_at');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BeneficiaryCourseRequest $request
     * @return Response
     */
    public function store(BeneficiaryCourseRequest $request)
    {
        return parent::storeBase($request, false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BeneficiaryCourseRequest $request
     * @param int $id
     * @return Response
     */
    public function update(BeneficiaryCourseRequest $request, int $id)
    {
        return parent::updateBase($request, $id);
    }
}
