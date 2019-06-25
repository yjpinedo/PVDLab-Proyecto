<?php

namespace App\Http\Controllers;

use App\Http\Requests\BeneficiaryLessonRequest;
use App\BeneficiaryLesson;
use Illuminate\Http\Response;

class BeneficiaryLessonController extends BaseController
{
    /**
     * Create a controller instance.
     *
     * @param BeneficiaryLesson $entity
     */
    public function __construct(BeneficiaryLesson $entity)
    {
        parent::__construct($entity, false);
        $this->model = $this->entity->with('beneficiary','lesson')->orderBy('created_at');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BeneficiaryLessonRequest $request
     * @return Response
     */
    public function store(BeneficiaryLessonRequest $request)
    {
        return parent::storeBase($request, false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BeneficiaryLessonRequest $request
     * @param int $id
     * @return Response
     */
    public function update(BeneficiaryLessonRequest $request, int $id)
    {
        return parent::updateBase($request, $id);
    }

}
