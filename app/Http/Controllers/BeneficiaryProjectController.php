<?php

namespace App\Http\Controllers;

use App\BeneficiaryProject;
use App\Http\Requests\BeneficiaryProjectRequest;
use Illuminate\Http\Response;

class BeneficiaryProjectController extends BaseController
{
    /**
     * Create a controller instance.
     *
     * @param BeneficiaryProject $entity
     */
    public function __construct(BeneficiaryProject $entity)
    {
        parent::__construct($entity, false);
        $this->model = $this->entity->with('project', 'beneficiary')->orderBy('created_at');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BeneficiaryProjectRequest $request
     * @return Response
     */
    public function store(BeneficiaryProjectRequest $request)
    {
        return parent::storeBase($request, false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BeneficiaryProjectRequest $request
     * @param int $id
     * @return Response
     */
    public function update(BeneficiaryProjectRequest $request, int $id)
    {
        return parent::updateBase($request, $id);
    }
}
